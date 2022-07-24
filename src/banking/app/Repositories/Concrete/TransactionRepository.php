<?php

namespace App\Repositories\Concrete;

use Illuminate\Support\Facades\DB;
use App\Traits\DateTimeTrait;
use App\Repositories\Abstracts\ITransactionRepository;

class TransactionRepository extends BaseRepository implements ITransactionRepository
{
    use DateTimeTrait;

    public function list($request)
    {
        $data = DB::table('transactions as t')
                    ->join('currencies as c', 't.currency_id', '=', 'c.id')
                    ->leftJoin('accounts as fa', 't.from_account_id', '=', 'fa.id')
                    ->rightJoin('accounts as ta', 't.to_account_id', '=', 'ta.id')
                    ->select('t.id', 'fa.owner as from_owner', 'ta.owner as to_owner', 'fa.id',
                             't.amount', 't.created_at', 'c.id as currency_id', 'c.code')
                    ->where('t.currency_id', $request->currency_id)
                    ->paginate($request->paginate);
        return $this->okResponse($data);
    }

    public function create($request)
    {
        try {
            DB::transaction(function () use ($request)
            {
                DB::table('accounts')->where('id', $request->fromAccount->id)->update([
                        'balance' => ($request->fromAccount->balance - $request->amount),
                    ]);

                DB::table('accounts')->where('id', $request->toAccount->id)->update([
                        'balance' =>($request->amount + $request->toAccount->balance),
                    ]);

                DB::table('entries')->insert([
                        'account_id' => $request->fromAccount->id,
                        'amount' => $request->amount,
                        'currency_id' => $request->currency_id,
                    ]);
            });
            return $this->okResponse('Transaction success');

        } catch (\Exception $e) {
            return $this->noDataResponse($e->getMessage());
        }
    }

    public function withdraws($AccountID, $request)
    {
        try {
            DB::transaction(function () use ($request, $AccountID)
            {
                DB::table('accounts')->where('id', $AccountID)->update([
                        'balance' => ($request->balance - $request->amount),
                    ]);

                DB::table('entries')->insert([
                        'account_id' => $AccountID,
                        'amount' => $request->amount,
                        'currency_id' => $request->currency_id,
                    ]);

            });
            $account = DB::table('accounts')->where('id', $AccountID)->first();
            return $this->okResponse($account);

        } catch (\Exception $e) {
            return $this->noDataResponse($e->getMessage());
        }
    }

    public function deposits($AccountID, $request)
    {
        try {
            DB::transaction(function () use ($request, $AccountID)
            {
                DB::table('accounts')->where('id', $AccountID)->update([
                        'balance' => ($request->balance + $request->amount),
                    ]);

                DB::table('entries')->insert([
                        'account_id' => $AccountID,
                        'amount' => $request->amount,
                        'currency_id' => $request->currency_id,
                    ]);
            });
            $account = DB::table('accounts')->where('id', $AccountID)->first();
            return $this->okResponse($account);

        } catch (\Exception $e) {
            return $this->noDataResponse($e->getMessage());
        }
    }

}
