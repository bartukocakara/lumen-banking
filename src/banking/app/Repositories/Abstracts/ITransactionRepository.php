<?php

namespace App\Repositories\Abstracts;

interface ITransactionRepository extends IRepository
{
    public function list($request);

    public function create($request);

    public function withdraws($AccountID, $request);

    public function deposits($AccountID, $request);

}
