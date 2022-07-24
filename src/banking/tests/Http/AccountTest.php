<?php

use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\DatabaseTransactions;
use App\Models\Account;

class AccountTest extends TestCase
{
    private const API_PREFIX = "api";
    private const API_VERSION = "v1";
    private const ZERO_BALANCE = 0;

    public function test_create_account() : void
    {
        $payload = [
            "owner" => "Bartu",
            "currency_id" => 1
        ];
        $headers = [
            "Accept" => "application/json",
        ];

        $test = $this->call('POST', self::API_PREFIX . DIRECTORY_SEPARATOR .
                                    self::API_VERSION . DIRECTORY_SEPARATOR . "accounts", $payload, $headers);
        $test->assertJson(json_decode($test->getContent(), true));
        $test->assertStatus(201);
    }

    public function test_list_account() : void
    {
        $query = [
            "paginate" => 15,
            "currency_id" => 1
        ];
        $headers = [
            "Accept" => "application/json",
        ];
        $test = $this->call('GET', self::API_PREFIX . DIRECTORY_SEPARATOR .
                                    self::API_VERSION . DIRECTORY_SEPARATOR .
                                    'accounts' . '?' . http_build_query($query), $headers);
        $test->assertJson(json_decode($test->getContent(), true));
        $test->assertStatus(200);
    }

    public function test_delete_account() : void
    {
        $AccountID = Account::all()->where('balance', self::ZERO_BALANCE)->first()->id;
        $test = $this->call('DELETE', self::API_PREFIX . DIRECTORY_SEPARATOR .
                                    self::API_VERSION . DIRECTORY_SEPARATOR .
                                    "accounts" . DIRECTORY_SEPARATOR . $AccountID);
        $test->assertJson(json_decode($test->getContent(), true));
        $test->assertStatus(200);
    }
}
