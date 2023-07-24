<?php

namespace App\DataTables;

use App\Spesies;
use Auth;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Illuminate\Support\HtmlString;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class SpesiesFrontEndDataTable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable($query)
    {
        return datatables()
            ->eloquent($query)
            ->editColumn('gambar', function ($row) {
                $data = $row->gambar;
                $imageUrl = asset('asset_dashboard/images/default_fish.png');

                if ($data) {
                    $gambar_spesies = json_decode($data, true)[0] ?? '';
                    $imageUrl = asset('storage/spesies/' . $gambar_spesies) ?? $imageUrl;
                }

                $imageHtml = '<img src="' . $imageUrl . '" alt="Image" width="100" height="100">';
                return new \Illuminate\Support\HtmlString($imageHtml);
            })
            ->editColumn('nama_latin', function($row){
                return strip_tags($row->nama_latin);
            })
            ->editColumn('nama_umum', function($row){
                return strip_tags($row->nama_umum);
            })
            ->editColumn('status', function($row) {
                $badgeClass = '';
                switch ($row->status) {
                    case 'checking':
                        $badgeClass = 'badge-warning';
                        break;
                    case 'verified':
                        $badgeClass = 'badge-info';
                        break;
                    case 'valid':
                        $badgeClass = 'badge-success';
                        break;
                    default:
                        $badgeClass = '';
                        break;
                }

                if (!empty($badgeClass)) {
                    return '<span class="badge ' . $badgeClass . '">' . $row->status . '</span>';
                } else {
                    return '-';
                }
            })
            ->rawColumns(['status'])
            ->addColumn('action', function ($row) {
                $action = ' <a href="' . route('member-explorer.edit', encrypt($row->id)) . '" data-jenis="edit" class="btn btn-warning btn-sm action">Edit</a>';
                $action .= ' <a href="#" data-id="' . encrypt($row->id) . '" data-jenis="hapus" class="btn btn-danger btn-sm action-hapus">Hapus</a>';

                return new \Illuminate\Support\HtmlString($action);
            })
            ->addIndexColumn()
            ->setRowId('id');
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\App\SpesiesDataTable $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Spesies $model)
    {
        return $model->where('user_id', Auth::user()->id)->newQuery();
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
                    ->setTableId('spesies-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    ->dom('Blfrtip')
                    ->orderBy(1)
                    ->buttons(
                        Button::make('create'),
                        Button::make('export'),
                        Button::make('print'),
                        Button::make('reset'),
                        Button::make('reload')
                    )
                    ->parameters([
                        "lengthMenu" => [[5, 10, 25, 50, 100, -1], [5, 10, 25, 50, 100, 'All']]
                    ]);
    }

    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns()
    {
        return [
            Column::make('DT_RowIndex')->searchable(false)->orderable(false)->title('No')->width(2),
            Column::make('gambar'),
            Column::make('nama_latin'),
            Column::make('nama_umum'),
            Column::make('status'),
            Column::computed('action')
                  ->exportable(false)
                  ->printable(false)
                  ->width(250)
                  ->addClass('text-center'),
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'Spesies_' . date('YmdHis');
    }
}
