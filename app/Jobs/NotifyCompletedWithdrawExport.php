<?php

namespace App\Jobs;

use App\Models\WithdrawExcel;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class NotifyCompletedWithdrawExport implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    protected $filename, $admin_id;

    public function __construct($filename, $admin_id)
    {
        //
        $this->filename = $filename;
        $this->admin_id = $admin_id;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $filename = $this->filename;
        $admin_id = $this->admin_id;

        $withdrawExcel = WithdrawExcel::create([
            'name' => $filename,
            'admin_id' => $admin_id,
        ]);

        $withdrawExcel->addMedia(storage_path('app/' . $filename))->toMediaCollection('file');
    }
}
