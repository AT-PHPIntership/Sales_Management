<?php

namespace App\Events;

use App\Models\BillDetail;
use App\Events\Event;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class BillWasCreatedEvent extends Event
{
    use SerializesModels;
    
    public $productID;
    public $amount;
    
    /**
     * Create a new event instance.
     *
     * @param array $productID contain product id from request
     * @param array $amount    contain amount correspond with product id
     *
     * @return void
     */
    public function __construct($productID, $amount)
    {
        $this->productID = $productID;
        $this->amount = $amount;
    }
}
