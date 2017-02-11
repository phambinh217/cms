<?php

namespace Phambinh\Cms\Setting\Models;

use Illuminate\Database\Eloquent\Model;
use Phambinh\Laravel\Database\Traits\Model as PhambinhModel;
use Phambinh\Laravel\Database\Traits\Query;

class Menu extends Model implements Query
{
    use PhambinhModel;

    protected $table = 'menus';

    protected $primaryKey = 'id';

    protected $fillable = [
        'name',
        'slug',
    ];

     /**
     * Các tham số được phép truyền vào từ URL
     *
     * @var array
     */
    protected static $requestFilter = [
        
    ];

    /**
     * Giá trị mặc định của các tham số
     *
     * @var array
     */
    protected static $defaultOfQuery = [
        'orderby'      =>  'id.desc',
    ];

    public function items()
    {
        return $this->hasMany('Phambinh\Cms\Setting\Models\MenuItem');
    }

    public function scopeOfQuery($query, $args = [])
    {
        $query->baseQuery($args);
    }
}
