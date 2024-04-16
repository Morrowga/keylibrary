<?php

namespace Thihaeung\KeyLibrary\Services;

use Thihaeung\KeyLibrary\Models\Key;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Thihaeung\KeyLibrary\Collections\KeyCollection;

class KeyService
{

    public static function getKeys ($modelId, $collectionName = null)
    {
        try {
            $keys = $collectionName != null
            ? Key::where('collection_name', $collectionName)
            ->where('model_id', $modelId)
            ->first()
            : Key::where('collection_name', 'keys')
            ->where('model_id', $modelId)
            ->first();

            return $keys;
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public static function getKey ($modelId,string $keyType, string $collectionName = null)
    {
        try {
            $publicKey = '';

            $key = $collectionName != null
            ? Key::where('collection_name', $collectionName)
            ->where('model_id', $modelId)
            ->first()
            : Key::where('collection_name', 'keys')
            ->where('model_id', $modelId)
            ->first();

            if(!empty($key))
            {
                return $keyType == 'public' ?  $key->public_key_string : $key->private_key_string;
            }

            throw new \Exception('No '. ucfirst($keyType) .' Key Found.');

        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public static function storeKeys(Model $model, $publicKeyString, $privateKeyString, $collectionName = null)
    {
        try {
            $currentTimestamp = time();

            $collectionName = $collectionName == null ? 'keys' : $collectionName;

            $basePath = 'public/' . $collectionName . '/' . $model->getKey();
            $publicKeyPath = $basePath . '/public.pem';
            $privateKeyPath = $basePath . '/private.pem';

            if (!Storage::exists($basePath)) {
                Storage::makeDirectory($basePath, 0755, true);
            }

            Storage::put($publicKeyPath, self::formatKey($publicKeyString));
            Storage::put($privateKeyPath, self::formatKey($privateKeyString));

            $morphType = $model->getMorphClass();
            $morphId = $model->getKey();

            Key::create([
                'model_id' => $morphId,
                'model_type' => $morphType,
                'collection_name' => $collectionName,
                'timestamp' => $currentTimestamp,
                'public_key_path' => $publicKeyPath,
                'private_key_path' => $privateKeyPath,
            ]);
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    private static function formatKey($keyString)
    {
        return $keyString;
    }

    public static function deleteKey($modelId, $collectionName = null)
    {
        $collectionName = $collectionName == null ? 'keys' : $collectionName;

        $basePath = 'public/' . $collectionName  . '/' . $modelId;

        if (Storage::exists($basePath)) {

            Storage::deleteDirectory($basePath);

            Key::where('model_id', $modelId)->delete();

        } else {
            throw new \Exception('No key file path found for the specified model and collection.');
        }
    }

    public static function deleteKeyCollection($collectionName = null)
    {
        $basePath = 'public/' . $collectionName;

        if (Storage::exists($basePath)) {
            Storage::deleteDirectory($basePath);

            $key = Key::where('collection_name', $collectionName)->delete();

        } else {

            throw new \Exception('No collection found.');

        }
    }

}
