<?php

namespace App\Http\Validations;

use App\Repositories\Abstracts\ITransactionRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use InvalidArgumentException;
use App\Traits\ApiResponseTrait;
use Illuminate\Support\Facades\DB;

class TransactionValidation
{
    use ApiResponseTrait;

    private const DEF_PAGINATION = 10;
    private const DEF_CURRENCY_ID = 1;

    /**
     * @var ITransactionRepository
     */
    private ITransactionRepository $repository;

    /**
     * TransactionValidation constructor.
     * @param ITransactionRepository $transactionRepository
     */
    public function __construct(ITransactionRepository $transactionRepository)
    {
        $this->repository = $transactionRepository;
    }

    public function create($request)
    {
        $data = $request->only('from_account_id', 'to_account_id', 'amount', 'currency_id');
        $validator = Validator::make($data, [
            'from_account_id' => 'required|exists:accounts,id',
            'to_account_id' => 'required|exists:accounts,id',
            'amount' => 'required|numeric|min:2|max:1000',
            'currency_id' => 'required|exists:currencies,id',
        ]);
        if ($validator->fails()) {
            return $this->validationFailResponse($validator->messages());
        }
        $response = '';
        $fromAccount = DB::table('accounts')->where([
                    'id'  => $request->from_account_id,
                    'currency_id' => $request->currency_id
                ])
                ->where('balance', '>=', $request->amount)
                ->select('balance', 'id', 'currency_id')
                ->first();
        if(is_null($fromAccount)) {
            $response = 'No sender account found[Wrong accountID && Unsufficient balance]';
            return $this->noDataResponse($response);
        }
        $toAccount = DB::table('accounts')->where([
                    'id' => $request->to_account_id,
                    'currency_id' => $request->currency_id,
                ])
                ->select('balance', 'id', 'currency_id')
                ->first();
        if(is_null($toAccount)) {
            $response = 'No receiver account found[Wrong accountID && Wrong currencyID]';
            return $this->noDataResponse($response);
        }
        $request->fromAccount = $fromAccount;
        $request->toAccount = $toAccount;
        return $this->repository->create($request);
    }

    public function list($request)
    {
        $request->paginate ?? self::DEF_PAGINATION;
        $request->currency_id ?? self::DEF_CURRENCY_ID;
        return $this->repository->list($request);
    }

    public function withdraws($AccountID, $request)
    {
        $data = $request->only('amount', 'currency_id');
        $validator = Validator::make($data, [
            'amount' => 'required|numeric|min:2|max:1000',
            'currency_id' => 'required|exists:currencies,id',
        ]);
        if ($validator->fails()) {
            return $this->validationFailResponse($validator->messages());
        }
        $account = DB::table('accounts')->where([
            'id'  => $AccountID,
            'currency_id' => $request->currency_id
            ])
            ->where('balance', '>=', $request->amount)
            ->select('balance', 'id', 'currency_id')
            ->first();
        if(is_null($account)) {
            $response = 'No sender account found[Wrong accountID && Unsufficient balance]';
            return $this->noDataResponse($response);
        }
        $request->balance = $account->balance;
        return $this->repository->withdraws($AccountID, $request);
    }

    public function deposits($AccountID, $request)
    {
        $data = $request->only('amount', 'currency_id');
        $validator = Validator::make($data, [
            'amount' => 'required|numeric|min:2|max:1000',
            'currency_id' => 'required|exists:currencies,id',
        ]);

        $account = DB::table('accounts')->where([
            'id'  => $AccountID,
            'currency_id' => $request->currency_id
                ])
                ->select('balance', 'id', 'currency_id')
                ->first();
        if(is_null($account)) {
            $response = 'No sender account found[Wrong accountID && Wrong currencyID]';
            return $this->noDataResponse($response);
        }
        $request->balance = $account->balance;
        return $this->repository->deposits($AccountID, $request);
    }

}
