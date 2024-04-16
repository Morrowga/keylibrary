<?php

namespace Thihaeung\KeyLibrary\Traits;

use Thihaeung\KeyLibrary\Models\Key;
use Thihaeung\KeyLibrary\Services\KeyService;

trait HasKeyCollection
{
    public function addToKeyCollection($publicKeyString, $privateKeyString,$collectionName = null)
    {
        KeyService::storeKeys($this, $publicKeyString, $privateKeyString, $collectionName);
    }

    public function getKeys($collectionName = null)
    {

        $modelId = $this->id;

        $keys = KeyService::getKeys($modelId, $collectionName);

        return $keys;
    }

    public function getPublicKey($collectionName = null)
    {

        $modelId = $this->id;

        $key = KeyService::getKey($modelId,'public', $collectionName);

        return $key;
    }

    public function getPrivateKey($collectionName = null)
    {
        $modelId = $this->id;

        $key = KeyService::getKey($modelId,'private', $collectionName);

        return $key;
    }

    public function deleteKeyFromCollection($collectionName = null)
    {
        $deleteKey = KeyService::deleteKey($this->id, $collectionName);
    }
}
