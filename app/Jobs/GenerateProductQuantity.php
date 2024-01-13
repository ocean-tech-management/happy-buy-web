<?php

namespace App\Jobs;

use App\Models\ProductBatch;
use App\Models\ProductQrLog;
use App\Models\ProductQuantity;
use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class GenerateProductQuantity implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    protected $batch_id;
    protected $product_id;
    protected $product_variant_id;
    protected $batch_quantity;
    protected $color_id;
    protected $size_id;
    protected $cost_price;

    public function __construct($batch_id, $product_id, $product_variant_id, $batch_quantity, $color_id, $size_id, $cost_price)
    {
        //
        $this->batch_id = $batch_id;
        $this->product_id = $product_id;
        $this->product_variant_id = $product_variant_id;
        $this->batch_quantity = $batch_quantity;
        $this->color_id = $color_id;
        $this->size_id = $size_id;
        $this->cost_price = $cost_price;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $batch_id = $this->batch_id;
        $product_id = $this->product_id;
        $product_variant_id = $this->product_variant_id;
        $batch_quantity = $this->batch_quantity;
        $color_id = $this->color_id;
        $size_id = $this->size_id;
        $cost_price = $this->cost_price;

        $productBatch = ProductBatch::whereId($batch_id)->first();
        $productBatch->update([
            'generated_at' => Carbon::now()
        ]);

        for($i = 0; $i < $batch_quantity; $i++){
            $productQuantity = ProductQuantity::create([
                'batch_id' => $batch_id,
                'product_id' => $product_id,
                'product_variant_id' => $product_variant_id,
                'status' => 1,
                'qr_code' => ProductQrLog::generateProductQr($product_id, $color_id, $size_id),
                'qr_generate_at' => Carbon::now(),
                'cost_price' => $cost_price,
            ]);
        }

    }
}
