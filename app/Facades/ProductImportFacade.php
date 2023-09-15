<?php

namespace App\Facades;

use Illuminate\Support\Facades\Facade;

class ProductImportFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
       
        return 'product-import';
    }
}
