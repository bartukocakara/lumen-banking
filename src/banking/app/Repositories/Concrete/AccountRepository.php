<?php

namespace App\Repositories\Concrete;

use App\Repositories\Abstracts\IAccountRepository;
use Illuminate\Support\Facades\DB;
use App\Traits\DateTimeTrait;

class AccountRepository extends BaseRepository implements IAccountRepository
{
    use DateTimeTrait;

    private const ZERO_BALANCE = 0;

    public function list($request)
    {
        $data = DB::table("accounts as a")
                    ->join('currencies as c', 'a.currency_id', '=', 'c.id')
                    ->select('a.id', 'a.owner', 'a.member_since', 'a.currency_id', 'c.code', 'a.balance')
                    ->where('currency_id', $request->currency_id)
                    ->paginate($request->paginate);
        return $this->okResponse($data);
    }

    public function create($request)
    {
        return $this->createdResponse(DB::table("accounts")->insert( $request->all() ));
    }

    public function delete($AccountID)
    {
        $delete = DB::table("accounts")->where(
            [
                'id' => $AccountID,
                'balance' => self::ZERO_BALANCE
            ]
            )->delete();
        if($delete == 0) {
            return $this->badRequestResponse('You still have money in your account');
        }
        return $this->okResponse($delete);
    }
}
