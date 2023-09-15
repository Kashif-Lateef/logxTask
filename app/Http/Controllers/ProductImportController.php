<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Facades\ProductImportFacade;
use App\Events\ProductAdded; // Import the ProductAdded event
use App\Models\Product;
use App\Mail\DuplicateSKUMail; // Import the email notification class
use Illuminate\Support\Facades\Mail;
use Illuminate\Validation\ValidationException;

class ProductImportController extends Controller
{
    public function index()
    {
        return view('import.index');
    }

    public function store(Request $request)
    {
        $request->validate([
            'csv_file' => 'required|file|mimes:csv,txt',
        ]);

        $file = $request->file('csv_file');
        $filePath = $file->storeAs('csv', 'products.csv', 'public');

        try {
            ProductImportFacade::importFromCSV(storage_path('app/public/' . $filePath));
            
            return redirect()->route('import.index')->with('success', 'CSV file imported successfully.');
        } catch (\Exception $e) {
            return redirect()->route('import.index')->with('error', 'An error occurred during CSV import: ' . $e->getMessage());
        }
    }
}
