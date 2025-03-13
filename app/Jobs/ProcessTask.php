<?php

namespace App\Jobs;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Log;

class ProcessTask implements ShouldQueue //Alex 创建任务类
{
    use Queueable;

    /**
     * Create a new job instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $data = '3';
        // 处理任务逻辑，例如发送邮件或处理数据
        Log::info('Task processed: ' . $data);
    }
}
