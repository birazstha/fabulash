<?php

namespace App\Observers;

use App\Models\Inventory;
use App\Models\Product;

class InventoryObserver
{
    public function created(Product $product): void
    {
        Inventory::create([
            'product_id' => $product->id,
            'created_by' => 1,
        ]);
    }

    /**
     * Handle the Product "updated" event.
     */
    public function updated(Product $product): void
    {
        //
    }

    /**
     * Handle the Product "deleted" event.
     */
    public function deleted(Product $product): void
    {
        //
    }

    /**
     * Handle the Product "restored" event.
     */
    public function restored(Product $product): void
    {
        //
    }

    /**
     * Handle the Product "force deleted" event.
     */
    public function forceDeleted(Product $product): void
    {
        //
    }
}
