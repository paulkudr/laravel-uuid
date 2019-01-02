<?php

namespace Paulkudr\LaravelUuid;

use Illuminate\Database\Eloquent\Model;
use Ramsey\Uuid\Uuid;

trait HasUuid
{
    public static function bootHasUuid()
    {
        static::creating(function($model) {
            $model->{$model->getKeyName()} = Uuid::uuid4();
        });

        if(property_exists($this, 'uuids') && is_array($this->uuids)) {
            $this->uuids = array_merge($this->uuids, [$this->getKeyName()]);
        } else {
            $this->uuids = [$this->getKeyName()];
        }
    }

    public function getIncrementing()
    {
        return false;
    }

    public function getAttribute($key)
    {
        if(in_array($key, $this->uuids)) {
            return Uuid::fromBytes($this->{$key});
        }

        return parent::getAttribute($key);
    }

    public function setAttribute($key, $value)
    {
        if(in_array($key, $this->uuids)) {
            if($value instanceof Uuid) {
                $value = ($value->getBytes());
            }
        }

        return parent::setAttribute($key, $value);
    }
}
