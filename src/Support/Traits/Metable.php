<?php

namespace Packages\Cms\Support\Traits;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Collection as BaseCollection;

trait Metable
{
    
    /**
     * Meta scope for easier join
     * -------------------------
     */
    public function scopeMeta($query)
    {
        return $query->join($this->getMetaTable(), $this->table.'.' . $this->primaryKey, '=', $this->getMetaTable().'.'.$this->getMetaKeyName())
            ->select($this->table.'.*');
    }

    /**
     * Set Meta Data functions
     * -------------------------
     */

    public function setMeta($key, $value = null)
    {
        $setMeta = 'setMeta' . ucfirst(gettype($key));

        return $this->$setMeta($key, $value);
    }

    protected function setMetaString($key, $value)
    {
        $key = strtolower($key);
        if ($this->metaData->has($key)) {

            // Make sure deletion marker is not set
            $this->metaData[$key]->markForDeletion(false);

            $this->metaData[$key]->value = $value;

            return $this->metaData[$key];
        }

        return $this->metaData[$key] = $this->getModelStub([
            'key'   => $key,
            'value' => $value
        ]);
    }

    protected function setMetaArray()
    {
        list($metas) = func_get_args();

        foreach ($metas as $key => $value) {
            $this->setMetaString($key, $value);
        }

        return $this->metaData->sortByDesc('id')
            ->take(sizeof($metas));
    }

    /**
     * Unset Meta Data functions
     * -------------------------
     */

    public function unsetMeta($key)
    {
        $unsetMeta = 'unsetMeta' . ucfirst(gettype($key));

        return $this->$unsetMeta($key);
    }

    protected function unsetMetaString($key)
    {
        $key = strtolower($key);
        if ($this->metaData->has($key)) {
            $this->metaData[$key]->markForDeletion();
        }
    }

    protected function unsetMetaArray()
    {
        list($keys) = func_get_args();

        foreach ($keys as $key) {
            $key = strtolower($key);
            $this->unsetMetaString($key);
        }
    }

    /**
     * Get Meta Data functions
     * -------------------------
     */

    public function getMeta($key = null, $raw = false)
    {
        if (is_string($key) && preg_match('/[,|]/is', $key, $m)) {
            $key = preg_split('/ ?[,|] ?/', $key);
        }

        $getMeta = 'getMeta' . ucfirst(strtolower(gettype($key)));

        return $this->$getMeta($key, $raw);
    }

    protected function getMetaString($key, $raw = false)
    {
        $meta = $this->metaData->get($key, null);

        if (is_null($meta) || $meta->isMarkedForDeletion()) {
            return null;
        }

        return ($raw) ? $meta : $meta->value;
    }

    protected function getMetaArray($keys, $raw = false)
    {
        $collection = new BaseCollection();

        foreach ($this->metaData as $meta) {
            if (! $meta->isMarkedForDeletion() && in_array($meta->key, $keys)) {
                $collection->put($meta->key, $raw ? $meta : $meta->value);
            }
        }

        return $collection;
    }

    protected function getMetaNull()
    {
        list($keys, $raw) = func_get_args();

        $collection = new BaseCollection();

        foreach ($this->metaData as $meta) {
            if (! $meta->isMarkedForDeletion()) {
                $collection->put($meta->key, $raw ? $meta : $meta->value);
            }
        }

        return $collection;
    }

    /**
     * Query Meta Table functions
     * -------------------------
     */

    public function whereMeta($key, $value)
    {
        return $this->getModelStub()
            ->whereKey(strtolower($key))
            ->whereValue($value)
            ->get();
    }

    /**
     * Trait specific functions
     * -------------------------
     */

    protected function setObserver()
    {
        $this->saved(function ($model) {
            $model->saveMeta();
        });
    }

    protected function getModelStub()
    {
        // get new meta model instance
        $model = new \Packages\Cms\Services\MetaData();
        $model->setTable($this->metaTable);

        // model fill with attributes.
        if (func_num_args() > 0) {
            array_filter(func_get_args(), array($model, 'fill'));
        }

        return $model;
    }

    protected function saveMeta()
    {
        foreach ($this->metaData as $meta) {
            $meta->setTable($this->metaTable);

            if ($meta->isMarkedForDeletion()) {
                $meta->delete();
                continue;
            }

            if ($meta->isDirty()) {
                // set meta and model relation id's into meta table.
                $meta->setAttribute($this->metaKeyName, $this->modelKey);
                $meta->save();
            }
        }
    }

    protected function getMetaData()
    {
        if (! isset($this->metaLoaded)) {
            $this->setObserver();

            if ($this->exists) {
                $objects = $this->getModelStub()
                    ->where($this->metaKeyName, $this->modelKey)
                    ->get();

                if (! is_null($objects)) {
                    $this->metaLoaded = true;

                    return $this->metaData = $objects->keyBy('key');
                }
            }
            $this->metaLoaded = true;

            return $this->metaData = new Collection();
        }
    }

    /**
     * Return the key for the model
     *
     * @return string
     */
    protected function getModelKey()
    {
        return $this->getKey();
    }

    /**
     * Return the foreign key name for the meta table
     *
     * @return string
     */
    protected function getMetaKeyName()
    {
        return isset($this->metaKeyName) ? $this->metaKeyName : $this->getForeignKey();
    }

    /**
     * Return the table name
     *
     * @return null
     */
    protected function getMetaTable()
    {
        return isset($this->metaTable) ? $this->metaTable : $this->getTable() . '_meta';
    }

    /**
     * Convert the model instance to an array.
     *
     * @return array
     */
    public function toArray()
    {
        return array_merge(parent::toArray(), [
            'meta_data' => $this->getMeta()->toArray(),
        ]);
    }

    /**
     *
     *
     *
     * @param
     * @return
     * @author BinhPham
     */
    public function fill(array $attributes)
    {
        foreach ($attributes as $key => $value) {
            if (in_array($key, $this->fillableMeta) && ! in_array($key, $this->fillable)) {
                \Log::info("setMeta( $key, $value )");
                $this->setMeta($key, $value);
                unset($attributes[$key]);
            }
        }

        return parent::fill($attributes);
    }

    /**
     * Model Override functions
     * -------------------------
     */

    /**
     * Get an attribute from the model.
     *
     * @param  string $key
     * @return mixed
     */
    public function getAttribute($key)
    {
        // parent call first.
        if (($attr = parent::getAttribute($key)) !== null) {
            return $attr;
        }

        // there was no attribute on the model
        // retrieve the data from meta relationship
        return $this->getMeta($key);
    }

    public function __unset($key)
    {
        // unset attributes and relations
        parent::__unset($key);

        // delete meta
        $this->unsetMeta($key);
    }

    public function __get($attr)
    {
        // Check for meta accessor
        $accessor = camel_case('get_' . $attr . '_meta');

        if (method_exists($this, $accessor)) {
            return $this->{$accessor}();
        }

        // Check for legacy getter
        $getter = 'get' . ucfirst($attr);

        // leave model relation methods for parent::
        $isRelationship = method_exists($this, $attr);

        if (method_exists($this, $getter) && ! $isRelationship) {
            return $this->{$getter}();
        }

        return parent::__get($attr);
    }

    public function __set($key, $value)
    {
        // ignore the trait properties being set.
        if (starts_with($key, 'meta') || $key == 'query') {
            $this->$key = $value;

            return;
        }

        // if key is a model attribute, set as is
        if (array_key_exists($key, parent::getAttributes())) {
            parent::setAttribute($key, $value);

            return;
        }

        // if the key has a mutator execute it
        $mutator = camel_case('set_' . $key . '_meta');

        if (method_exists($this, $mutator)) {
            $this->{$mutator}($value);
            return;
        }

        // if key belongs to meta data, append its value.
        if ($this->metaData->has($key)) {
            /*if ( is_null($value) ) {
                $this->metaData[$key]->markForDeletion();
                return;
            }*/
            $this->metaData[$key]->value = $value;

            return;
        }

        // if model table has the column named to the key
        if (\Schema::hasColumn($this->getTable(), $key)) {
            parent::setAttribute($key, $value);
            return;
        }

        // key doesn't belong to model, lets create a new meta relationship
        //if ( ! is_null($value) ) {
        $this->setMetaString($key, $value);
        //}
    }

    public function __isset($key)
    {
        // trait properties.
        if (starts_with($key, 'meta') || $key == 'query') {
            return isset($this->{$key});
        }

        // check parent first.
        if (parent::__isset($key) === true) {
            return true;
        }

        // lets check meta data.
        return isset($this->getMetaData()[$key]);
    }

    /**
     * Save the model to the database.
     *
     * @param  array  $options
     * @return bool
     */
    public function save(array $options = [])
    {
        $query = $this->newQueryWithoutScopes();

        // If the "saving" event returns false we'll bail out of the save and return
        // false, indicating that the save failed. This provides a chance for any
        // listeners to cancel save operations if validations fail or whatever.
        if ($this->fireModelEvent('saving') === false) {
            return false;
        }

        // If the model already exists in the database we can just update our record
        // that is already in this database using the current IDs in this "where"
        // clause to only update this model. Otherwise, we'll just insert them.
        if ($this->exists) {
            $saved = $this->isDirty() ?
                        $this->performUpdate($query) : false;
        }

        // If the model is brand new, we'll insert it into our database and set the
        // ID attribute on the model to the value of the newly inserted row's ID
        // which is typically an auto-increment value managed by the database.
        else {
            $saved = $this->performInsert($query);
        }

        $this->finishSave($options);

        return $saved;
    }
}