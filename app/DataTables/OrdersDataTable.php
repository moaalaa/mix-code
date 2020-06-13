<?php

namespace MixCode\DataTables;

use Yajra\DataTables\Services\DataTable;
use MixCode\Order;
use MixCode\User;

class OrdersDataTable extends DataTable
{
    use BuilderParameters;

    public function dataTable($query)
    {
        return datatables($query)
            ->addColumn('checkbox', '<input type="checkbox" class="selected_data" name="selected_data[]" value="{{ $id }}">')
            // ->addColumn('user_name',function($model){ return 'sdad';})
            ->addColumn('show', 'dashboard.orders.buttons.show')
            ->addColumn('delete', 'dashboard.orders.buttons.delete')
            ->rawColumns(['checkbox','show', 'delete']);
    }

    public function query(Order $model)
    {
        return $model->newQuery()->with(['cards','users'])->select('orders.*');
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
                'name' => "users.full_name",
                'data'    => 'users.full_name',
                'title'   => trans('main.user'),
                'searchable' => true,
                'orderable'  => true,
                'width'          => '200px',
            ],
            
            [
                'name' => "users.phone",
                'data'    => 'users.phone',
                'title'   => trans('main.phone'),
                'searchable' => true,
                'orderable'  => true,
                'width'          => '200px',
            ],
            
            [
                'name' => "users.email",
                'data'    => 'users.email',
                'title'   => trans('main.email'),
                'searchable' => true,
                'orderable'  => true,
                'width'          => '200px',
            ],

            
            [
                'name' => "cards.discount",
                'data'    => 'cards.name_by_lang',
                'title'   => trans('main.cards'),
                'searchable' => true,
                'orderable'  => true,
                'width'          => '200px',
            ]
           ,
            [
                'name' => 'status',
                'data' => 'status',
                'title' => trans('main.status'),
                // 'class' => ['no-export'],
                'exportable' => true,
                'printable'  => true,
                'searchable' => true,
                'orderable'  => false,
            ],

            
            [
                'name' => 'show',
                'data' => 'show',
                'title' => trans('main.show'),
                'class' => ['no-export'],
                'exportable' => false,
                'printable'  => false,
                'searchable' => false,
                'orderable'  => false,
            ]
        ];
    }

    protected function getButtons() : array
    {
        return [
            [
                'text' => '<i class="fas fa-trash"></i> ' . trans('main.delete'),
                'className' => 'btn btn-danger deleteBtn',
            ],
            [
                'extend' => 'print', 
                'className' => 'btn btn-dark', 
                'text' => '<i class="fas fa-print"></i> ' . trans('main.print'),
                'exportOptions' => [
                    // Exclude No Exportable, Printable Fields
                    'columns' => ':not(.no-export)'
                ],
            ],
            [
                'extend' => 'excelHtml5', 
                'className' => 'btn btn-success', 
                'text' => '<i class="fas fa-file-excel"> </i> ' . trans('main.export_excel'),
                'exportOptions' => [
                    // Exclude No Exportable, Printable Fields
                    'columns' => ':not(.no-export)'
                ],
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
        return 'Order_' . date('YmdHis');
    }
}
