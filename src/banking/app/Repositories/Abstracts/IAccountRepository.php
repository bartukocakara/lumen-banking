<?php

namespace App\Repositories\Abstracts;

interface IAccountRepository extends IRepository
{
    public function list($request);

    public function create($request);

    public function delete($AccountID);
}
