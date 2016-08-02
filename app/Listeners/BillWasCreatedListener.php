<?php

namespace App\Listeners;

use App\Events\BillWasCreatedEvent;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Models\Product;

class BillWasCreatedListener
{
    /**
     * Handle the event.
     *
     * @param BillWasCreatedEvent $event event
     *
     * @return void
     */
    public function handle(BillWasCreatedEvent $event)
    {
        $size = count($event->productID);
        for ($i=0; $i < $size; $i++) {
            $product = Product::findOrFail($event->productID[$i]);
            $product->remaining_amount -=  $event->amount[$i];
            $product->save();
        }
    }
}
