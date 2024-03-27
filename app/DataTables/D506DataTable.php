<?php

namespace App\DataTables;

use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;
use App\Models\D506;
use Carbon\Carbon;

class D506DataTable extends DataTable
{
	/**
	 * Build the DataTable class.
	 *
	 * @param QueryBuilder $query Results from query() method.
	 */
	public function dataTable(QueryBuilder $query): EloquentDataTable {
		return (new EloquentDataTable($query))
		->addColumn('status', function($data) {
			$result = match ((int)$data->status) {
				200 => "<span class='badge badge-success'>ข้อมูลใหม่</span>",
				default => "<span class='badge badge-danger'>ผิดพลาด</span>",
			};
			return $result;
		})
		->addColumn('action', function($data) {
			$result = match ((int)$data->message_code) {
				200 => "<span class='text-success'>ส่งแล้ว</span>",
				default => "<a class='btn btn-sm btn-primary waves-effect' href='".route('d506.report.edit', ['id' => $data->id])."'>แก้ไข</a>",
				// <button type='button' class='btn btn-sm btn-primary waves-effect' onClick='send({$data})'>ส่งข้อมูล</button>",
			};
			return $result;
		})
		->editColumn('created_at', function($data) {
			$dt = Carbon::create($data->created_at);
			return $dt->toDateTimeString();
		})
		->setRowId('id')
		->rawColumns(['status', 'action']);
	}

	/**
	 * Get the query source of dataTable.
	 */
	public function query(D506 $model): QueryBuilder {
		return $model?->whereDate('created_at', '=', date('Y-m-d'));
	}

	/**
	 * Optional method if you want to use the html builder.
	 */
	public function html(): HtmlBuilder {
		return $this->builder()
					->setTableId('d506-table')
					->columns($this->getColumns())
					->minifiedAjax()
					->dom('Bfrtip')
					->orderBy(0)
					->selectStyleSingle()
					->serverSide(true)
					->responsive(true)
					// ->stateSave(true)
					->processing(true)
					->deferRender(true)
					->language('/json/thai.json')
					->stripeClasses(['strip1', 'strip2']);
					// ->buttons([
					// 	Button::make('excel'),
					// 	Button::make('csv'),
					// 	Button::make('pdf'),
					// 	Button::make('print'),
					// 	Button::make('reset'),
					// 	Button::make('reload')
					// ]);
	}

	/**
	 * Get the dataTable columns definition.
	 */
	public function getColumns(): array {
		return [
			// 	  ->exportable(false)
			// 	  ->printable(false)
			// 	  ->width(60)
			// 	  ->addClass('text-center'),
			Column::make('id')->title('รหัส'),
			Column::make('first_name')->title('ชื่อ'),
			Column::make('last_name')->title('นามสกุล'),
			Column::make('status')->title('สถานะ'),
			Column::make('message')->title('ข้อความ'),
			Column::make('created_at')->title('วันที่'),
			Column::computed('action')->title('จัดการ')->className('text-center'),
		];
	}

	/**
	 * Get the filename for export.
	 */
	protected function filename(): string {
		return 'D506_' . date('YmdHis');
	}
}
