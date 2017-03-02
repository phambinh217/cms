<?php

namespace Phambinh\Cms\Support\Traits;

trait Thumbnail
{
    public function getThumbnailAttribute($value)
    {
        if (!empty($value)) {
            return $value;
        }

        return setting('default-thumbnail', upload_url('no-thumbnail.png'));
    }
}
