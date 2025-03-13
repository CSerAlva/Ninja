<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;

/*
|--------------------------------------------------------------------------
| Console Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of your Closure based console
| commands. Each Closure is bound to a command instance allowing a
| simple approach to interacting with each command's IO methods.
|
*/
Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote')->hourly();

//写一下简单的命令行脚本 make:command 命令。 Zy
Artisan::command('testConsole', function () {
    $this->line('Hello ZyBlog');
});

Artisan::command('question', function () {
    $food = $this->choice('选择午餐', [
        '面条',
        '米饭',
        '包子'
    ]);

    $this->line('您的选择是：' . $food);
});
