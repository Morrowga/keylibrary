<?php

namespace Thihaeung\KeyLibrary\Commands;

use Illuminate\Console\Command;
use Thihaeung\KeyLibrary\Services\KeyService;

class DeleteKeyCollectionCommand extends Command
{
    protected $signature = 'key:delete-collection {collection}';

    protected $description = 'Delete a key collection';

    public function handle()
    {
        $collection = $this->argument('collection');

        KeyService::deleteKeyCollection($collection);

        $this->info("Key collection '{$collection}' deleted successfully.");
    }
}
