<?php

namespace App\Listeners;

use App\Events\DonationCreated;
use App\Models\Inventory;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class DonationCreatedListener
{
    
    public function handle(DonationCreated $event)
    {
        Inventory::create([
            'user_id' => $event->donation->user_id,
            'product_id' => $event->donation->product_id,
            'quantity' => $event->donation->quantity,
        ]);
    }
}
