<?php

namespace FatwaKB\LaravelQRIS\Facades;

use Illuminate\Support\Facades\Facade;

class QRIS extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'laravel-qris';
    }
}
