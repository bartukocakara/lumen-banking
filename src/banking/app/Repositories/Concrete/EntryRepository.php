<?php

namespace App\Repositories\Concrete;

use Illuminate\Support\Facades\DB;
use App\Traits\ApiResponse;
use App\Repositories\Abstracts\IEntryRepository;
use App\Traits\ApiResponseTrait;
use Illuminate\Support\Facades\Artisan;

class EntryRepository extends BaseRepository implements IEntryRepository
{
    use ApiResponseTrait;
    protected $connection = 'remote_mysql';

    public function synchronisation()
    {

    }


}
