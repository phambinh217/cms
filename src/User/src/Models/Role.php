<?php 

namespace Phambinh\Cms\User\Models;

use Phambinh\Laravel\Database\Traits\Query;
use Phambinh\Laravel\Database\Traits\Model as PhambinhModel;
use Phambinh\Laravel\Database\Traits\Metable;
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

    /**
     *
     *
     *
     * @param
     * @return
     * @author BinhPham
     */
    public function users()
    {
        return $this->hasMany('Phambinh\Cms\User\Models\User');
    }
    // --------------------------------------------------------------------

    /**
     *
     *
     *
     * @param
     * @return
     * @author BinhPham
     */
    public function permissions()
    {
        return $this->hasMany('Phambinh\Cms\User\Models\Permission');
    }
    // --------------------------------------------------------------------
    
    /**
     *
     *
     *
     * @param
     * @return
     * @author BinhPham
     */
    public function scopeOfQuery($query, $args = [])
    {
        
        $query->baseQuery($args);
    }
    // --------------------------------------------------------------------

    /**
     *
     *
     *
     * @param
     * @return
     * @author BinhPham
     */
    public function getType($role_id)
    {
        if ($role_id) {
            $type = $this->find($role_id)->value('type');
        } else {
            $type = $this->type;
        }

        return $type;
    }
    // --------------------------------------------------------------------

    /**
     *
     *
     *
     * @param
     * @return
     * @author BinhPham
     */
    public function isFull($role_id = null)
    {
        return $this->getType($role_id) == '*';
    }
    // --------------------------------------------------------------------

    /**
     *
     *
     *
     * @param
     * @return
     * @author BinhPham
     */
    public function isEmpty($role_id = null)
    {
        return $this->getType($role_id) == '0';
    }
    // --------------------------------------------------------------------

    /**
     *
     *
     *
     * @param
     * @return
     * @author BinhPham
     */
    public function isOption($role_id = null)
    {
        return $this->getType($role_id) == 'option';
    }
    // --------------------------------------------------------------------

    public function isAdmin()
    {
        if ($this->isEmpty()) {
            return false;
        }
        
        return true;
    }
}
