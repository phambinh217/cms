<?php

namespace Phambinh\Cms\Setting\Models;

use Illuminate\Database\Eloquent\Model;
use Phambinh\Laravel\Database\Traits\Model as PhambinhModel;
use Phambinh\Laravel\Database\Traits\Query;

class MenuItem extends Model implements Query
{
    use PhambinhModel;

    protected $table = 'menu_items';

    protected $primaryKey = 'id';

    protected $fillable = [
        
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

    public function scopeOfQuery($query, $args = [])
    {
        $query->baseQuery($args);
    }

    public function hasChild()
    {
        return $this->ofQuery(['parent_id'], $this->id)->count() != 0;
    }

    public function scopeOfParentAble($query)
    {
        $query->where('id', '!=', $this->id)->where('parent_id', '!=', $this->id);
    }
}
