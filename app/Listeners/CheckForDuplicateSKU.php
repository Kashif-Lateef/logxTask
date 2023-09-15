<?php

namespace App\Listeners;

use App\Events\ProductAdded;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;
use App\Mail\CustomMail;
use App\Models\Product;


class CheckForDuplicateSKU
{
    use InteractsWithQueue;
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle($event)
    {
        $duplicate = Product::where('sku', $event->sku)->exists();

        if ($duplicate) {
            Mail::to('qazikashif745gmail.com')->send(new CustomMail($event->sku));
        }
    }
}
