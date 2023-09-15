<?php

namespace App\Services;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use App\Events\ProductAdded;
use App\Models\Product;

class ProductImportService
{
    public function importFromCSV($filePath)
    {
        $csv = array_map('str_getcsv', file($filePath));
        $header = array_shift($csv);

        $chunks = array_chunk($csv, 100);

        foreach ($chunks as $chunk) {
            Product::insert($this->transformCSVToProductData($chunk));
        }
    }

    protected function transformCSVToProductData($csvData)
    {
        $products = [];

        foreach ($csvData as $data) {
            $products[] = [
                'title' => $data[0],
                'description' => $data[1],
                'sku' => $data[2],
                'type' => $data[3],
                'cost_price' => 0.00,
                'status' => $data[4],
                'created_at' => now(),
                'updated_at' => now(),
            ];
            event(new ProductAdded($data[2]));
        }

        return $products;
    }
}
