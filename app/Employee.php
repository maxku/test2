<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Employee extends Model
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];

    protected $fillable
        = [
            'id',
            'full_name',
            'position',
            'salary',
            'boss_id',
            'image',
        ];

    protected $table = 'employees';

    public $timestamps = false;

    public function getTableColumns()
    {
        return $this->getConnection()->getSchemaBuilder()
            ->getColumnListing($this->getTable());
    }

}
