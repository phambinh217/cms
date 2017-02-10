<?php

namespace Phambinh\Cms\Setting\Supports\Traits;

trait NavigationMenu
{
    public function menuItems()
    {
        return $this->hasMany('Phambinh\Cms\Setting\Models\MenuItem', 'object_id')->where('type', __CLASS__);
    }

    public function scopeAddToMenu($query, $menu_id, $params = [])
    {
        $data = array_merge([
            'type' => __CLASS__,
            'object_id' => $this->id,
            'url' => $this->menuUrl(),
            'title' => $this->menuTitle(),
            'menu_id' => $menu_id,
        ], $params);

        return $this->menuItems()->insert($data);
    }
}
