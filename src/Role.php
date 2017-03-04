<?php 

namespace Phambinh\Cms;

use Phambinh\Cms\Support\Traits\Query;
use Phambinh\Cms\Support\Traits\Model as PhambinhModel;
use Phambinh\Cms\Support\Traits\Metable;
use Illuminate\Database\Eloquent\Model;

class Role extends Model implements Query
{
    use PhambinhModel;

    protected $fillable = [
        'id',
        'name',
        'type',
    ];

    protected static $requestFilter = [
        'id' => 'integer',
        'name' => 'max:255',
        'orderby' => 'max:255',
    ];

    protected static $defaultOfQuery = [
        'orderby'    => 'name.desc',
    ];

    /**
     * Các trường được sinh thêm trong quá trình Group by
     * Sử dụng trong sắp xếp
     */
    protected $fieldPlugin = [
        'total_user',
    ];

    public function users()
    {
        return $this->hasMany('Phambinh\Cms\User');
    }

    public function permissions()
    {
        return $this->hasMany('Phambinh\Cms\Permission');
    }
    
    public function scopeOfQuery($query, $args = [])
    {
        $args = $this->defaultParams($args);
        $query->baseQuery($args);
    }

    public function getType($role_id)
    {
        if ($role_id) {
            $type = $this->find($role_id)->value('type');
        } else {
            $type = $this->type;
        }

        return $type;
    }

    public function isFull($role_id = null)
    {
        return $this->getType($role_id) == '*';
    }

    public function isEmpty($role_id = null)
    {
        return $this->getType($role_id) == '0';
    }

    public function isOption($role_id = null)
    {
        return $this->getType($role_id) == 'option';
    }

    public function isAdmin()
    {
        if ($this->isEmpty()) {
            return false;
        }
        
        return true;
    }
}
