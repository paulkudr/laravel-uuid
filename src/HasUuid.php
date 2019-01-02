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
    }

    public function getIncrementing()
    {
        return false;
    }

    public function getAttribute($key)
    {
        if(in_array($key, $this->getUuids())) {
            return Uuid::fromBytes($this->{$key});
        }

        return parent::getAttribute($key);
    }

    public function setAttribute($key, $value)
    {
        if(in_array($key, $this->getUuids())) {
            if($value instanceof Uuid) {
                $value = $value->getBytes();
            }
        }

        return parent::setAttribute($key, $value);
    }

    private function getUuids() {
        if(property_exists($this, 'uuids') && is_array($this->uuids)) {
            return array_merge($this->uuids, [$this->getKeyName()]);
        } else {
            return [$this->getKeyName()];
        }
    }
}
