<?php

namespace App\Traits;

trait ModelCrudTrait
{
    protected function ifDataExists($data, $model, $dataName = false)
    {
        if(count($data) == 0)
        {
            return __("models.".$model).
                   __("actions.".config("response-messages.NOT_FOUND"));
        }
        return $data;
    }

    protected function ifArrayDataExists($array)
    {
        $data = [];
        foreach ($array as $key =>  $value)
        {
            if(count($value) != 0)
            {
                $data[$key] = $value;
            }
            else {
                $data[$key] = __("actions.".config("response-messages.NOT_FOUND"));
            }
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
}
