<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $fillable = [
        'title',
        'description'
    ];

    protected static function getList($request)
    {
        $title = $request->title;
        $description = $request->description;
        $orderBy = static::getOrderBy($request->order_by);
        $query = static::orderBy($orderBy->value, $orderBy->way);

        if ($title) {
            $query = $query->where('title', $title);
        }

        if ($description) {
            $query = $query->where('description', $description);
        }

        $query = $query->paginate(10);

        return $query;
    }

    private static function getOrderBy($field) {
        $app = app();
        $obj = $app->make('stdClass');

        if (!$field) {
            $obj->value = 'id';
            $obj->way = 'desc';

            return $obj;
        }

        $way = substr($field, 0, 1) === '-' ? 'desc' : 'asc';
        $value = $way === 'desc' ? substr($field, 1, strlen($field)) : $field;

        $obj->value = $value;
        $obj->way = $way;

        return $obj;
    }
}
