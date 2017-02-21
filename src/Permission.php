<?php

namespace Packages\Cms;

use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'role_id',
        'permission'
    ];

    public function role()
    {
        return $this->beLongsTo('Packages\Cms\Role');
    }
}
