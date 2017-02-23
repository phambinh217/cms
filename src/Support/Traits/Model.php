<?php

namespace Phambinh\Cms\Support\Traits;

use Illuminate\Support\Facades\Input;
use Validator;

trait Model
{ 
    public static function getRequestFilter($defaultFilter = [])
    {
        $requestFilter = array_merge(self::$defaultOfQuery, $defaultFilter, Input::all());

        $validator = Validator::make($requestFilter, self::$requestFilter);

        $fieldErros = [];
        if ($validator->fails()) {
            $fieldErros = array_keys($validator->errors()->toArray());
        }

        foreach ($requestFilter as $field => $value) {
            if (in_array($field, $fieldErros) || ! isset(self::$requestFilter[$field])) {
                unset($requestFilter[$field]);
            }
        }
        
        return array_map('trim', $requestFilter);
    }

    public static function scopeLinkSort($query, $text, $fieldOrder)
    {
        $filter = self::getRequestFilter();
        $url = \Request::fullUrlWithQuery(['orderby' => $fieldOrder.'.desc' ]);
        if (starts_with($filter['orderby'], $fieldOrder.'.')) {
            if (ends_with($filter['orderby'], '.asc')) {
                return '<a href="'. $url .'" class="asc">'. $text .'</a>';
            } else {
                $url = \Request::fullUrlWithQuery(['orderby' => $fieldOrder.'.asc' ]);
                return '<a href="'. $url .'" class="desc">'. $text .'</a>';
            }
        }

        return '<a href="'. $url .'">'. $text .'</a>';
    }

    public function scopeBaseQuery($query, $args = [])
    {
        if (! empty($args['id'])) {
            $query->where($this->table. '.' . $this->primaryKey, $args['id']);
        }

        if (! empty($args['orderby'])) {
            $orderby = explode('.', $args['orderby']);

            $allowField = array_merge($this->fillable, isset($this->fieldPlugin) ? $this->fieldPlugin : []);

            $field = isset($orderby[0]) && in_array($orderby[0], $allowField) ?
                $orderby[0] :
                $this->primaryKey;
            
            $order = isset($orderby[1]) && in_array($orderby[1], ['desc', 'asc', 'DESC', 'ASC']) ?
                $orderby[1] :
                'desc';

            $query->orderBy($field, $order);
        }

        if (! empty($args['limit'])) {
            $query->limit($args['limit']);
        }

        if (! empty($args['offset'])) {
            $query->offset($args['offset']);
        }
    }
}
