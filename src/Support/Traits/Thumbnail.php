<?php

namespace Phambinh\Cms\Support\Traits;

trait Thumbnail
{
    public function thumbnailOrDefault()
    {
        if (property_exists($this, 'thumbnail')) {
            $thumbnail = $this->thumbnail();
        } else {
            $thumbnail = 'thumbnail';
        }

        if (empty($this->{$thumbnail})) {
            return setting('default-thumbnail', upload_url('no-thumbnail.png'));
        }

        return $this->{$thumbnail};
    }
}
