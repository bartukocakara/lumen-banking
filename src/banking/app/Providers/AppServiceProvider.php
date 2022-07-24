<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use App\Repositories\Abstracts\IAccountRepository;
use App\Repositories\Concrete\AccountRepository;
use App\Repositories\Abstracts\ITransactionRepository;
use App\Repositories\Concrete\TransactionRepository;
use App\Repositories\Abstracts\IEntryRepository;
use App\Repositories\Concrete\EntryRepository;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application Validations.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(IAccountRepository::class, AccountRepository::class);
        $this->app->bind(ITransactionRepository::class, TransactionRepository::class);
        $this->app->bind(IEntryRepository::class, EntryRepository::class);
    }
}
