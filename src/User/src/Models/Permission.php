<?php 

namespace Phambinh\Cms\User\Models;

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
        return $this->beLongsTo('Phambinh\Cms\User\Models\Role');
    }
}
