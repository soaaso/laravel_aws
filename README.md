## MEMO
```
laravel new laravel_aws
cd laravel
composer require aws/aws-sdk-php-laravel
composer update
php artisan vendor:publish  --provider="Aws\Laravel\AwsServiceProvider"
# config/aws.phpで使用する変数名AWS_REGIONは.envで定義されていない。(AWS_DEFAULT_REGIONはある)なので追加する必要あり
vim .env
php artisan make:command S3Test
vim app/Console/Commands/S3Test.php
php artisan S3_test
```
