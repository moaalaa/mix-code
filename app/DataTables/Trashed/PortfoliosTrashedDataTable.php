<?php

namespace MixCode\DataTables\Trashed;

use Illuminate\Database\Eloquent\Model;
use Yajra\DataTables\Services\DataTable;
use MixCode\Portfolio;
use MixCode\DataTables\BuilderParameters;

class PortfoliosTrashedDataTable extends DataTable
{
    use BuilderParameters;

    public function dataTable($query)
    {
        return datatables($query)
            ->addColumn('checkbox', '<input type="checkbox" class="selected_data" name="selected_data[]" value="{{ $id }}">')
            ->addColumn('client_name', function (Model $portfolio) { return $portfolio->client->en_name; })
            ->addColumn('category', function (Model $portfolio) { return $portfolio->category->name_by_lang; })
            ->addColumn('restore', 'dashboard.portfolios.buttons.restore')
            ->addColumn('delete', 'dashboard.portfolios.buttons.force_delete')
            ->rawColumns(['checkbox', 'restore', 'delete', 'type']);
    }

    public function query(Portfolio $model)
    {
        return $model->newQuery()->where('creator_id', auth()->id())->onlyTrashed()->select('*');
    }

    public function html()
    {
        $html = $this->builder()
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->parameters($this->getCustomBuilderParameters([1, 2]));

        if (isLang('ar')) {
            $html = $html->parameters($this->getCustomBuilderParameters([1, 2], [], true));
        }

        return $html;
    }

    protected function getColumns()
    {
        return [
            [
                'name'              => 'checkbox',
                'data'              => 'checkbox',
                'title'             => '<input type="checkbox" class="select-all" onclick="select_all()">',
                'orderable'         => false,
                'searchable'        => false,
                'exportable'        => false,
                'printable'         => false,
                'width'             => '10px',
                'aaSorting'         => 'none',
                'class'             => ['no-export'],
            ],
            [
                'name' => "client_name",
                'data'    => 'client_name',
                'title'   => trans('main.client'),
                'searchable' => true,
                'orderable'  => true,
                'width'          => '200px',
            ],

            [
                'name' => "category",
                'data'    => 'category',
                'title'   => trans('main.category'),
                'searchable' => true,
                'orderable'  => true,
                'width'          => '200px',
            ],
        
            [
                'name' => 'restore',
                'data' => 'restore',
                'title' => trans('main.restore'),
                'class' => ['no-export'],
                'exportable' => false,
                'printable'  => false,
                'searchable' => false,
                'orderable'  => false,
            ],
            [
                'name' => 'delete',
                'data' => 'delete',
                'title' => trans('main.delete'),
                'class' => ['no-export'],
                'exportable' => false,
                'printable'  => false,
                'searchable' => false,
                'orderable'  => false,
            ],
        ];
    }

    protected function getButtons() : array
    {
        return [
        

            [
                'text' => '<i class="fas fa-trash"></i> ' . trans('main.delete'),
                'className' => 'btn btn-danger deleteBtn',
            ],
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'Portfolio_' . date('YmdHis');
    }
}
