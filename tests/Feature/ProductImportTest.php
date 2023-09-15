<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Tests\TestCase;

class ProductImportTest extends TestCase
{
    use RefreshDatabase;

    public function test_can_import_csv_file()
    {
        $file = new UploadedFile(
            storage_path('app/csv/sample.csv'),
            'sample.csv',
            'text/csv',
            null,
            true
        );

        $response = $this->post(route('import.store'), ['csv_file' => $file]);

        $response->assertStatus(302); // Check for a successful redirect
        $this->assertDatabaseCount('products', 3); // Adjust as needed
    }
}
