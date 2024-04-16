<?php

namespace Thihaeung\KeyLibrary\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Key extends Model
{

    protected $table = 'keys';

    protected $fillable = ['model_type', 'model_id', 'uuid', 'public_key_path','timestamp', 'private_key_path', 'collection_name'];

    protected $appends = [
        'public_key_string', 'private_key_string',
    ];

    public function getPublicKeyStringAttribute()
    {
        return $this->getKeyString('public');
    }

    public function getPrivateKeyStringAttribute()
    {
        return $this->getKeyString('private');
    }

    public function getKeyString($type)
    {
        $keyPath = $type === 'public' ? $this->public_key_path : $this->private_key_path;

        if (Storage::exists($keyPath)) {
            return Storage::get($keyPath);
        } else {
            return null;
        }
    }

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($key) {
            $key->uuid = Str::uuid();
        });
    }
}
