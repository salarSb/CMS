<?php

namespace Modules\Admin\Traits;

use Illuminate\Http\Request;

trait DataTable
{
    protected static function generateDataTable(Request $request)
    {
        $page = 1;
        $start = $request->start;
        $length = $request->length;
        if ($length > 0) {
            $page = intdiv($start, $length);
        }
        $datatable = [];
        $query = self::query();
        $columns = (new self)->fillable;
        foreach ($columns as $column) {
            $query->orWhere($column, 'LIKE', '%' . $request->search['value'] . '%');
        }
        // Paginate parameters: $perPage, $columns, $pageName, $page
        $data = $query->latest()->paginate($length, ['*'], 'page', $page + 1)->toArray();
        $datatable['data'] = $data['data'];
        $datatable['recordsTotal'] = $data['total'];
        $datatable['recordsFiltered'] = $data['total'];
        $datatable['draw'] = (int)$request->draw;
        return $datatable;
    }
}
