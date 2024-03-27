<?php

namespace App\Traits;

use App\Models\{Province,District,SubDistrict};

trait Boundary {

	public function getMinProvince(): ?array {
		$provinces = Province::select('province_id', 'province_name')->get();
		foreach ($provinces as $key => $val) {
			$prov[$val->province_id] = $val->province_name;
		}
		asort($prov);
		return $prov;
	}

	public function getDistrictByProv($prov_code=0): array {
		$districts = [];
		District::whereProvince_id($prov_code)->orderBy('district_id', 'asc')->get()->each(function($item, $key) use (&$districts) {
			$tmp['district_id'] = $item->district_id;
			$tmp['district_name'] = $item->district_name;
			$tmp['province_id'] = $item->province_id;
			$tmp['district_id_2_digit'] = substr($item->district_id, 2);
			array_push($districts, $tmp);
		});
		return $districts;
	}

	public function getSubDistrictByDistrict($dist_code=0): array {
		$subDistricts = [];
		SubDistrict::whereDistrict_id($dist_code)->orderBy('sub_district_id', 'asc')->get()->each(function($item, $key) use (&$subDistricts) {
			$tmp['sub_district_id'] = $item->sub_district_id;
			$tmp['sub_district_name'] = $item->sub_district_name;
			$tmp['district_id'] = $item->district_id;
			$tmp['province_id'] = $item->province_id;
			$tmp['sub_district_id_2_digit'] = substr($item->sub_district_id, 4);
			array_push($subDistricts, $tmp);
		});
		return $subDistricts;
	}

	// public function getDistrictNameById($dist_id=0): array {
	// 	return District::select('district_name')->whereDistrict_id($dist_id)->get()->toArray();
	// }

	// public function getSubDistrictNameById($sub_dist_id=0): array {
	// 	return SubDistrict::select('sub_district_name')->whereSubDistrict_id($sub_dist_id)->get()->toArray();
	// }

	// public function getMinDistrict(): array {
	// 	return District::select('district_id', 'district_name')->get()->keyBy('district_id')->toArray();
	// }

	// public function getMinSubDistrict(): array {
	// 	return SubDistrict::select('sub_district_id', 'sub_district_name')->get()->keyBy('sub_district_id')->toArray();
	// }

}
