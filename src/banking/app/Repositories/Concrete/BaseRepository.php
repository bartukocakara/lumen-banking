<?php

namespace App\Repositories\Concrete;

use App\Repositories\Abstracts\IRepository;
use Illuminate\Support\Facades\Cache;
use App\Traits\ApiResponseTrait;

class BaseRepository implements IRepository
{
    use ApiResponseTrait;

    protected function ifDataExists($data, $model, $dataName = false)
    {
        if($data == null)
        {
            return __("models.".$model).
                   __("actions.".config("response-messages.NOT_FOUND"));
        }
        return $data;
    }

    protected function updateResponse($update, $model)
    {
        if($update != 0)
        {
            return __("models.".$model).
                   __("actions.".config("response-messages.UPDATE_SUCCESS"));
        }
        return __("models.".$model).
                   __("actions.".config("response-messages.UPDATE_FAIL"));
    }

    protected function insertResponse($create, $model)
    {
        if($create != 0)
        {
            return __("models.".$model).
                   __("actions.".config("response-messages.CREATE_SUCCESS"));
        }
        return __("models.".$model).
                   __("actions.".config("response-messages.CREATE_FAIL"));
    }

    protected function deleteResponse($delete, $model)
    {
        if($delete != 0)
        {
            return __("models.".$model).
                   __("actions.".config("response-messages.DELETE_SUCCESS"));
        }
        return __("models.".$model).
                   __("actions.".config("response-messages.DELETE_FAIL"));
    }

}
