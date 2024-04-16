<p align="center"><img src="https://cdn.proprivacy.com/storage/images/proprivacy/2021/02/rsa-keysjpg-content_image-default.png" width="400" alt="RSA Logo"></p>

## Description 

In this package, you can easily store the rsa public & private key on your desire model with collection or wihtout collection: Features include, store, get, delete. I will show you with the examples.See below,

## Setup

Install package by command

```
composer require thihaeung/keylibrary
```
Publishing key table & Config

```
  php artisan vendor:publish --provider="Thihaeung\KeyLibrary\Providers\KeyServiceProvider" --tag=key-library-config --tag=key-migrations
```
Migrating table 

```
php artisan migrate
```

## Usage

Public Key Extension

- crt,pem,pub,key

Private Key Extension

- crt,pem,key

Use key trait in your desire model

```
use Thihaeung\KeyLibrary\Traits\HasKeyCollection;

use HasKeyCollection;
```

Store Key with collection or without collection. Note - if you don't add collection, the default collection will be  'keys' folder and key file extension will .pem .

- Without Collection

```
$model->addToKeyCollection($publicKey, $privateKey);
```

- With Collection

```
$model->addToKeyCollection($publicKey, $privateKey, $collectionName);
```

Fetching Key String and Key Path

- get Both Keys without Collection.

```
$model->getKeys();
```
- get Both Keys With Collection

```
$model->getKeys($collectionName);
```
- get only Public Key without Collection

```
$model->getPublicKey();
```
- get only Public Key with Collection

```
$model->getPublicKey($collectionName);
```
- get only Private Key without Collection

```
$model->getPrivateKey();
```
- get only Private Key with Collection

```
$model->getPrivateKey($collectionName);
```
- get Keys from all collections

```
$model->getAllCollectionKeys();
```
Deleting Keys

- delete Keys without collection

```
$model->deleteKeyFromCollection();
```
- delete Keys with collection

```
$model->deleteKeyFromCollection($collectionName);
```
- Delete Collection Commands

```
php artisan key:delete-collection collectionName
```

