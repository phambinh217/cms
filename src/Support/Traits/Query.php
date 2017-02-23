<?php

namespace Packages\Cms\Support\Traits;

interface Query
{
    public function scopeOfQuery($query, $args = []);
}
