<?php

namespace Phambinh\Cms\User\Models;

use App\User as AppUser;
use Phambinh\Laravel\Database\Traits\Query;
use Phambinh\Laravel\Database\Traits\Metable;
use Phambinh\Laravel\Database\Traits\Model as PhambinhModel;

class User extends AppUser implements Query
{
    use PhambinhModel, Metable;

    /**
     * The database table meta used by the model.
     *
     * @var string
     */
    protected $metaTable = 'user_metas';

    /**
     * The foreign key name for the meta table
     *
     * @var string
     */
    protected $metaKeyName = 'user_id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id',
        'name',
        'email',
        'password',
        'status',
        'role_id',
        'last_name',
        'first_name',
        'birth',
        'phone',
        'avatar',
        'address',
    ];

    /**
     * Các trường được sinh thêm trong quá trình Group by
     * Sử dụng trong sắp xếp
     */
    protected $fieldPlugin = [
        
    ];

    /**
     * The attributes table meta
     *
     * @var array
     */
    protected $fillableMeta = [
        'website',
        'facebook',
        'google_plus',
        'about',
        'job',
    ];
    
    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token'
    ];

    /**
     * Các tham số được phép truyền vào từ URL
     *
     * @var array
     */
    protected static $requestFilter = [
        'id' => 'integer',
        'name' => 'max:255',
        'email' => 'email',
        'status' => 'in:all,enable,disable',
        'role_id' => 'integer',
        'phone' => 'max:255',
        'orderby' => 'max:255',
        'last_name' => 'max:255',
        'first_name' => 'max:255',
        '_keyword' => '',
    ];

    /**
     * Giá trị mặc định của các tham số
     *
     * @var array
     */
    protected static $defaultOfQuery = [
        'status'        => 'enable',
        'orderby'       =>  'first_name.asc',
    ];

    /**
     * Lưu trạng thái
     * @var array
     */
    protected static $statusAble = [
        [ 'slug' => 'enable', 'name' => 'Bình thường'],
        ['slug' => 'disable','name' => 'Cấm',],
    ];

    protected static $searchFields = [
        'users.id',
        'users.first_name',
        'users.last_name',
        'users.email',
        'users.phone',
        'users.name',
    ];

    /**
     * Một người dùng có một quyền
     * @return object model
     */
    public function role()
    {
        return $this->beLongsTo('Phambinh\Cms\User\Models\Role');
    }

    /**
     * Một người dùng có nhiều tin nhắn gửi đến
     * @return object model
     */
    public function inbox()
    {
        return $this->hasMany('Phambinh\Cms\Mail\Models\Mail', 'receiver_id');
    }

    /**
     * Một người dùng có nhiều tin nhắn gửi đi
     * @return object model
     */
    public function outbox()
    {
        return $this->hasMany('Phambinh\Cms\Mail\Models\Mail', 'sender_id');
    }

    /**
     * Truy vấn
     * @param  object
     * @param  array  $args  Tham số
     * @return void
     */
    public function scopeOfQuery($query, $args = [])
    {
        $query->baseQuery($args);

        if (! empty($args['status'])) {
            switch ($args['status']) {
                case 'enable':
                    $query->enable();
                    break;

                case 'disable':
                    $query->disable();
                    break;
            }
        }

        if (! empty($args['_keyword'])) {
            $query->search($args['_keyword']);
        }

        if (! empty($args['last_name'])) {
            $query->where('last_name', $args['last_name']);
        }

        if (! empty($args['phone'])) {
            $query->where('phone', $args['phone']);
        }

        if (! empty($args['email'])) {
            $query->where('email', $args['email']);
        }

        if (! empty($args['first_name'])) {
            $query->where('first_name', $args['first_name']);
        }

        if (! empty($args['name'])) {
            $query->where('name', $args['name']);
        }

        if (! empty($args['role_id'])) {
            $query->where('role_id', $args['role_id']);
        }
    }

    public function scopeEnable($query)
    {
        return $query->where('users.status', '1');
    }

    public function scopeSearch($query, $keyword)
    {
        $keyword = str_keyword($keyword);
        foreach (self::$searchFields as $index => $field) {
            if ($index == 0) {
                $query->where($field, 'like', $keyword);
            } else {
                $query->orWhere($field, 'like', $keyword);
            }
        }
    }

    public function scopeDisable($query)
    {
        return $query->where('users.status', '0');
    }

    public function markAsEnable()
    {
        $this->where('id', $this->id)->update(['status' => '1']);
    }

    public function markAsDisable()
    {
        $this->where('id', $this->id)->update(['status' => '0']);
    }

    public static function getStatusAble()
    {
        return self::$statusAble;
    }

    /**
     * Kiểm tra $user_id có phải là người đang đăng nhập không
     * @param  int  $user_id
     * @return boolean
     */
    public function isSelf($user_id)
    {
        if (! \Auth::check()) {
            return false;
        }

        return \Auth::user()->id == $user_id;
    }

    /**
     * Kiểm tra người dùng có đang trong trạng thái bình thường
     * @return boolean
     */
    public function isEnable()
    {
        return $this->status == 1;
    }

    /**
     * Kiểm tra người dùng có đang trong trạng thái bị cấm
     * @return boolean
     */
    public function isDisable()
    {
        return $this->status == 0;
    }

    /**
     * Lấy tên đầy đủ dựa vào họ và tên thật
     * @return string
     */
    public function getFull_name()
    {
        return $this->last_name .' '. $this->first_name;
    }

    /**
     * Avatar mặc định hoặc avatar thật
     * @return string
     */
    public function avatarOrDefault()
    {
        if (! empty($this->avatar)) {
            return $this->avatar;
        }
        
        return setting('default-avatar', config('cms.default-avatar'));
    }
}
