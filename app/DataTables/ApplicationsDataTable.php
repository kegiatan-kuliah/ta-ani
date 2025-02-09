<?php

namespace App\DataTables;

use App\Models\Application;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class ApplicationsDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addIndexColumn()
            ->addColumn('name', function($model) {
                return $model->employee->name;
            })
            ->addColumn('nip', function($model) {
                return $model->employee->identity_no;
            })
            ->addColumn('action', function($model){ 
                return '
                    <div class="d-flex gap-2">
                        <a href="'.route('application.detail', $model->id).'" class="btn btn-6 btn-ghost-primary w-100">
                            Detail
                        </a>
                    </div>
                ';
            })
            ->setRowId('id');
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(Application $model): QueryBuilder
    {
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
                    ->setTableId('applications-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    //->dom('Bfrtip')
                    ->orderBy(1)
                    ->selectStyleSingle()
                    ->buttons([
                        // Button::make('excel'),
                        // Button::make('csv'),
                        // Button::make('pdf'),
                        // Button::make('print'),
                        // Button::make('reset'),
                        // Button::make('reload')
                    ]);
    }

    /**
     * Get the dataTable columns definition.
     */
    public function getColumns(): array
    {
        return [
            Column::make('DT_RowIndex')
                ->searchable(false)
                ->exportable(false)
                ->printable(false)
                ->title('#')
                ->width(20),
            Column::make('application_no')->title('Nomor Permohonan'),
            Column::make('date')->title('Tanggal Permohonan'),
            Column::make('approval_date')->title('Tanggal Disetujui'),
            Column::make('total_quantity')->title('Jumlah'),
            Column::make('purpose')->title('Jenis Keperluan'),
            Column::make('name')->title('Nama'),
            Column::make('nip')->title('NIP'),
            Column::make('status'),
            Column::computed('action')
                  ->exportable(false)
                  ->printable(false)
                  ->width(60)
                  ->addClass('text-center'),
        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'Applications_' . date('YmdHis');
    }
}
