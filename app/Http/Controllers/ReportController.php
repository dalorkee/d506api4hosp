<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\View\View;
use Illuminate\Http\{RedirectResponse,Request};
use Illuminate\Support\Facades\{Gate,Log};
use App\Http\Requests\StoreD506Request;
use App\DataTables\D506DataTable;
use App\Models\{D506,Nations,Occu};
use App\Traits\{Common,Boundary};
use App\Services\{D506Prepare,D506Send,D506Store};

class ReportController extends Controller
{
	protected $d506PrepareService;
	protected $d506StoreService;
	protected $d506SendService;

	use Common, Boundary;

	public function __construct(D506Prepare $d506PrepareService, D506Store $d506StoreService, D506Send $d506SendService) {
		$this->d506PrepareService = $d506PrepareService;
		$this->d506StoreService = $d506StoreService;
		$this->d506SendService = $d506SendService;
	}

	protected function index(D506DataTable $dataTable): ?object {
		if (Gate::none(['isAdmin', 'isStaff'])) {
			return redirect()->back()->with('error', 'โปรดตรวจสอบสิทธิ์การใช้งาน');
		}
		return $dataTable->render('apps.report.index');
	}

	protected function store(StoreD506Request $request): RedirectResponse {
		$item = $request->toArray();
		$json = $this->d506PrepareService->setDataToJsonFromRequest(item: $item);
		$plain_data = $this->d506PrepareService?->setDataToArrayFromRequest(item: $item);
		$this->d506StoreService?->storeFromRequest(id: $request->id, json: $json, data: $plain_data);
		$response = $this->d506SendService?->send506(id: $request->id);
		if ($response) {
			return redirect()->back()->with('success', 'ส่งข้อมูลรหัสนี้ไปยัง DDS Server สำเร็จ');
		} else {
			return redirect()->back()->with('error', 'ไม่สามารถส่งข้อมูลรหัสนี้ได้ โปรดตรวจสอบ');
		}
		return redirect()->back()->with('error', 'ไม่มี Response ส่งกลับจากระบบ DDS Server');
	}

	protected function edit(Request $request) {
		try {
			if (Gate::none(['isAdmin', 'isStaff'])) {
				return redirect()->back()->with('error', 'โปรดตรวจสอบสิทธิ์การใช้งาน');
			}
			$query = D506::select('id', 'data')->whereId($request->id)->get();
			$id = $query[0]->id;
			$d506 = json_decode($query[0]->data, true);
			$epidem_report_guid = str_replace(['{', '}'], "", $d506['epidem_report']['epidem_report_guid']);

			$titleName = $this->titleName();
			$gender = $this->gender();
			$marital = $this->maritalStatus();
			$nations = Nations::select('code', 'nation')->get()->toArray();
			$provinces = $this->getMinProvince();
			$districts = $this->getDistrictByProv($d506['person']['chw_code']);
			$district_id = $d506['person']['chw_code'].$d506['person']['amp_code'];
			$sub_districts = $this->getSubDistrictByDistrict($district_id);
			$occu = Occu::select('occu_code_43', 'occu_desc_43')->get()->toArray();
			$person_status = $this->personStatus();
			$respirator_status = $this->respiratorStatus();
			$vaccinated_status = $this->vaccinatedStatus();
			$epidem_districts = $this->getDistrictByProv($d506['epidem_report']['epidem_chw_code']);
			$epidem_district_id = $d506['epidem_report']['epidem_chw_code'].$d506['epidem_report']['epidem_amp_code'];
			$epidem_sub_districts = $this->getSubDistrictByDistrict($epidem_district_id);
			$lab_result = $this->labResult();
			$patient_type = $this->patientType();

			return view('apps.report.edit', [
				'd506' => $d506,
				'id' => $id,
				'epidem_report_guid' => $epidem_report_guid,
				'titleName' => $titleName,
				'nations' => $nations,
				'gender' => $gender,
				'marital' => $marital,
				'provinces' => $provinces,
				'districts' => $districts,
				'districts' => $districts,
				'sub_districts' => $sub_districts,
				'occu' => $occu,
				'person_status' => $person_status,
				'respirator_status' => $respirator_status,
				'vaccinated_status' => $vaccinated_status,
				'epidem_districts' => $epidem_districts,
				'epidem_sub_districts' => $epidem_sub_districts,
				'lab_result' => $lab_result,
				'patient_type' => $patient_type,
			]);
		} catch (\Exception $e) {
			Log::error('Edit form failed: '.$e->getMessage());
			return redirect()->route('dds.logout')->with('error', $e->getMessage());
		}
	}
}
