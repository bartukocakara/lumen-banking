<?php

use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\DatabaseTransactions;

class EntryTest extends TestCase
{
    private const API_PREFIX = "api";
    private const API_VERSION = "v1";

    public function test_entries_synchronisation() : void
    {
        $test = $this->call('POST', self::API_PREFIX . DIRECTORY_SEPARATOR .
                                    self::API_VERSION . DIRECTORY_SEPARATOR .
                                    'entries' . DIRECTORY_SEPARATOR. 'synchronisation');
        $test->assertStatus(200);
    }
}
