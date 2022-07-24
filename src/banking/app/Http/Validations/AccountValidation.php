<?php

namespace App\Http\Validations;

use App\Repositories\Abstracts\IAccountRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Traits\ApiResponseTrait;

class AccountValidation
{
    private const DEF_PAGINATION = 10;
    private const DEF_CURRENCY_ID = 1;

    use ApiResponseTrait;

    /**
     * @var IAccountRepository
     */
    private IAccountRepository $repository;

    /**
     * AccountValidation constructor.
     * @param IAccountRepository $accountRepository
     */
    public function __construct(IAccountRepository $accountRepository)
    {
        $this->repository = $accountRepository;
    }

    public function list($request)
    {
        $request->paginate ?? self::DEF_PAGINATION;
        $request->currency_id ?? self::DEF_CURRENCY_ID;
        return $this->repository->list($request);
    }

    public function create($request)
    {
        $data = $request->only('owner', 'currency_id');
        $validator = Validator::make($data, [
            'owner' => 'required|string|min:2|max:50',
            'currency_id' => 'required|exists:currencies,id',
        ]);
        if ($validator->fails()) {
            return $this->validationFailResponse($validator->messages());
        }

        return $this->repository->create($request);
    }

}
