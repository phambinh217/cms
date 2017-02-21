<?php

namespace Phambinh\Cms\Services;

use Phambinh\Cms\User\Models\Role;
use Phambinh\Cms\User\Models\Permission;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Collection;

class AccessControl
{
    /**
     * Lưu tất cả các permission
     * @var array
     */
    public $permissions = [];

    /**
     * Lưu các vai trò
     * @var array
     */
    public $roles = [];
    
    public function __construct($permission)
    {
        $roles = [];
        $permission->select('role_id', 'permission')->get()->each(function ($item) use (&$roles) {
            $roles[$item['role_id']][] = $item['permission'];
        });

        $this->roles = $roles;
        $this->permissions = new Collection();
    }

    public function getRole($role_id)
    {
        if (isset($this->roles[$role_id])) {
            return $this->roles[$role_id];
        }

        return [];
    }

    public function define($name, $ability, $callback = null)
    {
        if (! $callback) {
            $self = $this;
            $callback = function ($user) use ($self, $ability) {
                return $self->baseCheck($user, $ability);
            };
        }

        $this->permissions->push([
            'name' => $name,
            'ability' => $ability,
            'callback' => $callback,
        ]);

        return Gate::define($ability, $callback);
    }

    public function baseCheck($user, $ability)
    {
        if ($user->role->isFull()) {
            return true;
        }

        if ($user->role->isEmpty()) {
            return false;
        }

        return in_array($ability, $this->getRole($user->role_id));
    }

    public function __call($method, $params)
    {
        if (! method_exists($this, $method)) {
            return call_user_func_array([$this->permissions, $method], $params);
        }
    }
}
