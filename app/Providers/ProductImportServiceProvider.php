<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Services\ProductImportService;

class ProductImportServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind('product-import', function ($app) {
            return new ProductImportService();
        });
    }
}
