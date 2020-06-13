<?php

namespace MixCode\DataTables;

use Yajra\DataTables\Services\DataTable;
use MixCode\User;

class UsersDataTable extends DataTable
{
    use BuilderParameters;

    public function dataTable($query)
    {
        return datatables($query)
            ->addColumn('checkbox', '<input type="checkbox" class="selected_data" name="selected_data[]" value="{{ $id }}">')
            ->editColumn('type', function ($model) {
                $type = null;

                if ($model->isCustomer()) {
                    $type = trans("main.customer");
             
                } else {
                    $type = trans("main.admin");
                }

                return $type;
            })
            ->editColumn('status', function ($model) {
                $status = null;

                if ($model->isActive()) {
                    $status = trans("main.active");
                } elseif ($model->isPending()) {
                    $status = trans("main.pending");
                } else {
                    $status = trans("main.disable");
                }

                return $status;
            })
            ->addColumn('show', 'dashboard.users.buttons.show')
            ->addColumn('edit', 'dashboard.users.buttons.edit')
            ->addColumn('delete', 'dashboard.users.buttons.delete')
            ->rawColumns(['checkbox','show','edit', 'delete', 'type']);
    }

    public function query(User $model)
    {
        return $model->newQuery()->select('*');
    }

    public function html()
    {
        $selectFields = [
            [
                'index_num' => 4,
                'selectValues' => [
                    User::CUSTOMER_TYPE => trans('main.customer'),
                    User::ADMIN_TYPE => trans('main.admin'),
                ]
            ],
            [
                'index_num' => 5,
                'selectValues' => [
                    User::ACTIVE_STATUS     => trans('main.active'),
                    User::PENDING_STATUS    => trans('main.pending'),
                    User::INACTIVE_STATUS   => trans('main.disable'),
                ]
            ]
        ];

        $html = $this->builder()
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->parameters($this->getCustomBuilderParameters([1, 2, 3], $selectFields));

        if (isLang('ar')) {
            $html = $html->parameters($this->getCustomBuilderParameters([1, 2, 3], $selectFields, true));
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
                'name' => "full_name",
                'data'    => 'full_name',
                'title'   => trans('main.full_name'),
                'searchable' => true,
                'orderable'  => true,
                'width'          => '200px',
            ],
            [
                'name' => "email",
                'data'    => 'email',
                'title'   => trans('main.email'),
                'searchable' => true,
                'orderable'  => true,
                'width'          => '200px',
            ],
            [
                'name' => "phone",
                'data'    => 'phone',
                'title'   => trans('main.phone'),
                'searchable' => true,
                'orderable'  => true,
                'width'          => '200px',
            ],
            [
                'name' => "type",
                'data'    => 'type',
                'title'   => trans('main.type'),
                'searchable' => true,
                'orderable'  => true,
                'width'          => '200px',
            ],
            [
                'name' => "status",
                'data'    => 'status',
                'title'   => trans('main.status'),
                'searchable' => true,
                'orderable'  => true,
                'width'          => '200px',
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
            ],
            [
                'name' => 'edit',
                'data' => 'edit',
                'title' => trans('main.edit'),
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

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'User_' . date('YmdHis');
    }
}
