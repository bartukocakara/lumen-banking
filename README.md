### Design Pattern
```
Controller => Validation => Repository
```

### Build

```
docker-compose up -d --build
```

### Docker Run
```
docker compose up
```

### Docker List Containers
```
docker ps
```
### Container execution
```
1-) docker exec -it i_phpfpm bash
2-) cd banking
```
# Now we can execute composer, artisan etc. commands.

### Install required packages
```
composer install
```
### https://github.com/DarkaOnLine/SwaggerLume
```
php artisan swagger-lume:generate
```
#### App url http://localhost:8081/api/v1/documentation
```
### Db migrate 
```
php artisan migrate --seed
```

### Db migrate partialy
```
php artisan migrate --path='./database/migrations/2022_07_18_003232_create_currencies_table.php' (Nothing to migrate. = Clear migrations table)
```
### Unit Test All
```
vendor/bin/phpunit
```
### Unit Test Filter
```
#Accounts
vendor/bin/phpunit --filter test_create_account
vendor/bin/phpunit --filter test_list_account
vendor/bin/phpunit --filter test_delete_account

#Transactions
vendor/bin/phpunit --filter test_create_transaction
vendor/bin/phpunit --filter test_withdraw_transaction
vendor/bin/phpunit --filter test_deposit_transaction
```
