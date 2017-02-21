<?php

namespace Phambinh\Cms;

use Phambinh\Laravel\Database\Traits\Query;
use Phambinh\Laravel\Database\Traits\Model as PhambinhModel;
use Illuminate\Database\Eloquent\Model;

class Mail extends Model
{
    use PhambinhModel;

    protected $table = 'messages';

    protected $fillable = [
        'id',
        'sender_id',
        'receiver_id',
        'subject',
        'content',
        'status',
        'check',
    ];

    /**
     * Các tham số được phép truyền vào từ URL
     *
     * @var array
     */
    protected static $requestFilter = [
        'id' => 'integer',
        'sender_id',
        'receiver_id',
        'subject',
        'content',
        'status',
        'check',
        'orderby',
    ];

    /**
     *
     */
    protected $fieldPlugin = [
        'first_name',
        'created_at',
    ];

    /**
     * Giá trị mặc định của các tham số
     *
     * @var array
     */
    protected static $defaultOfQuery = [
        'orderby'        =>    'created_at.desc',
    ];

    public function sender()
    {
        return $this->beLongsTo('Phambinh\Cms\User', 'sender_id');
    }

    public function receiver()
    {
        return $this->beLongsTo('Phambinh\Cms\User', 'receiver_id');
    }

    public function scopeOfQuery($query, $args = [])
    {
        $query->baseQuery($args);

        if (isset($args['check'])) {
            switch ($args['check']) {
                case 'checked':
                    dd($args['check']);
                    $query->where('check', '1');
                    break;
                
                case 'not-check':
                    $query->where('check', '0');
                    break;
            }
        }

        if (! empty($args['subject'])) {
            $query->where('subject', $args['subject']);
        }

        if (! empty($args['receiver_id'])) {
            $query->where('receiver_id', $args['receiver_id']);
        }

        if (! empty($args['sender_id'])) {
            $query->where('sender_id', $args['sender_id']);
        }

        if (! empty($args['created_at'])) {
            $query->where('created_at', $args['created_at']);
        }
    }

    /**
     *
     *
     *
     * @param
     * @return
     * @author BinhPham
     */
    public function avatarOrDefault()
    {
        if (! empty($this->avatar)) {
            return $this->avatar;
        }
        
        return setting('default-avatar');
    }

    /**
     *
     *
     *
     * @param
     * @return
     * @author BinhPham
     */
    public function full_name()
    {
        return $this->last_name . ' ' . $this->first_name;
    }
}
