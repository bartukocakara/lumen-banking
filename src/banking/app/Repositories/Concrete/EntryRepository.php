<?php

namespace App\Repositories\Concrete;

use Illuminate\Support\Facades\DB;
use App\Traits\ApiResponse;
use App\Repositories\Abstracts\IEntryRepository;
use App\Traits\ApiResponseTrait;

class EntryRepository extends BaseRepository implements IEntryRepository
{
    use ApiResponseTrait;

    public function synchronisation()
    {

    }


}
