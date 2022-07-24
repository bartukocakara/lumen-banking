<?php

use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\DatabaseTransactions;
use App\Models\Account;

class TransactionTest extends TestCase
{
    private const API_PREFIX = 'api';
    private const API_VERSION = 'v1';
    private const AMOUNT = 100;
    private const CURRENCY_ID = 1;

    public function test_transaction_create() : void
    {
        $amount = self::AMOUNT;
        $currencyID = self::CURRENCY_ID;
        $fromAccountID = Account::where('balance', '>=', $amount)
                                ->where('currency_id', '=', $currencyID)
                                    ->first()->id;
        $toAccountID = Account::where('id', '!=', $fromAccountID)
                              ->where('currency_id', $currencyID)
                              ->first()->id;
        $payload = [
            'from_account_id' => $fromAccountID,
            'to_account_id' => $toAccountID,
            'amount' => $amount,
            'currency_id' => $currencyID
        ];
        $headers = [
            'Accept' => 'application/json',
        ];
        $test = $this->call('POST', self::API_PREFIX . DIRECTORY_SEPARATOR .
                                    self::API_VERSION . DIRECTORY_SEPARATOR .
                                    'transactions', $payload, $headers);
        $test->assertJson(json_decode($test->getContent(), true));
        $test->assertStatus(200);
    }

    public function test_withdraw_transaction() : void
    {
        $amount = self::AMOUNT;
        $currencyID = self::CURRENCY_ID;
        $payload = [
            'amount' => $amount,
            'currency_id' => $currencyID
        ];
        $AccountID = Account::where('balance', '>=', $amount)
                                ->where('currency_id', '=', $currencyID)
                                ->first()->id;
        $headers = [
            'Accept' => 'application/json',
        ];
        $test = $this->call('PATCH', self::API_PREFIX . DIRECTORY_SEPARATOR .
                                     self::API_VERSION . DIRECTORY_SEPARATOR .
                                    'transactions'  . DIRECTORY_SEPARATOR .
                                    'withdraws' . DIRECTORY_SEPARATOR .$AccountID,
                                     $payload, $headers);
        $test->assertJson(json_decode($test->getContent(), true));
        $test->assertStatus(200);
    }

    public function test_deposit_transaction() : void
    {
        $amount = self::AMOUNT;
        $currencyID = self::CURRENCY_ID;
        $payload = [
            'amount' => $amount,
            'currency_id' => $currencyID
        ];
        $AccountID = Account::where('currency_id', '=', $currencyID)
                              ->first()->id;

        $headers = [
            'Accept' => 'application/json',
        ];
        $test = $this->call('PATCH', self::API_PREFIX . DIRECTORY_SEPARATOR .
                                    self::API_VERSION . DIRECTORY_SEPARATOR .
                                    'transactions' . DIRECTORY_SEPARATOR .
                                    'deposits' . DIRECTORY_SEPARATOR . $AccountID,
                                     $payload, $headers);
        $test->assertJson(json_decode($test->getContent(), true));
        $test->assertStatus(200);
    }
}
