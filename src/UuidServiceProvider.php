<?php

namespace Paulkudr\LaravelUuid;

use Illuminate\Support\ServiceProvider;
use Paulkudr\LaravelUuid\MySqlConnection;
use Illuminate\Database\Connection;

class UuidServiceProvider extends ServiceProvider
{
    public function boot()
    {

    }

    public function register()
    {
    {
        Connection::resolverFor('mysql', function ($connection, $database, $prefix, $config) {
            return new MySqlConnection($connection, $database, $prefix, $config);
        });
    }
    }
}
