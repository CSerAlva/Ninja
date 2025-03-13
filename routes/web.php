<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

use App\Jobs\ProcessTask;

use App\Http\Controllers\BookController;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\DojoController;
use App\Http\Controllers\NinjaController;
use App\Http\Controllers\RabbitMQController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

//RabbitMQ
Route::get('/rmq', [RabbitMQController::class, 'msg'])->name('rmq.msg');
//发送消息到队列 在控制器或路由中分发任务（推送任务到队列）：
Route::get('/send', function () {
    $data = 'Hello RabbitMQ!';
//    ProcessTask::dispatch(['key' => $data])->onQueue('high_priority');
    ProcessTask::dispatch(['key' => $data])->onQueue('task_queue');
    return '推送任务到队列，Message sent!!!';
});
//发送邮件
Route::get('/sendEmail', function () {
    SendEmailJob::dispatch()->onQueue('emails');
});
//RabbitMQ



Route::post('/ninjas', [NinjaController::class, 'store'])->name('ninjas.store');

////公有频道
//    //公有频道 Zy
//    Route::get('/broadcasting/Zy', function () {
//        broadcast(new \App\Events\Messages_Zy("[" . date('Y-m-d H:i:s') . "]新消息来了!"));
//    });
//    Route::view('broadcasting/Zy2', "broadcasting.messages");
//    //公有频道 Leo
//    Route::get('/broadcasting/Leo', function () {
//        broadcast(new \App\Events\Free_Leo("[" . date('Y-m-d H:i:s') . "]免缴农业税了!"));
//    });
//    Route::view('broadcasting/Leo2', "broadcasting.countryside");
//
////私有频道
////Laravel 提供的快速登录
//Route::get('/1', function () {
//    auth()->loginUsingId(1);
//});
//Route::get('/2', function () {
//    auth()->loginUsingId(2);
//});
//    // 触发事件的路由 Leo
//    Route::get('/broadcasting/Leo3', function () {
//        broadcast(new \App\Events\Prize_Leo("[" . date('Y-m-d H:i:s') . "]来领奖!"));
//    });
//
//    Route::view('/broadcasting/Leo4', "broadcasting.three_good");
//    Route::get('/broadcasting/Leo5', function () {
//        broadcast(new \App\Events\Prize_Leo("[" . date('Y-m-d H:i:s') . "]到教导处来领奖状!"))->toOthers(); //只对其他人广播
//    });

Auth::routes();

//内置实时群聊
Route::get('/login/user/{id}', fn($id) => auth()->loginUsingId($id)); //php7.4新出的箭头函数

Route::get('/room/{roomId}', function ($roomId) {
    broadcast(new \App\Events\Hello_Leo($roomId));
    //    return view('broadcasting.hello', compact(['roomId']));
//        return view('broadcasting.newMessage', compact(['roomId']));
    return view('broadcasting.chat', compact(['roomId']));
})->name('room.nowChat');
//定义聊天室群聊路由
Route::put('/room/{roomId}', [ChatController::class, 'msg'])->name('room.msg');
//
//
////Http测试
//Route::post('/test/post', function () {
//    return 1;
//});
//
//Route::post('/test/post/json', function () {
//    return ['a' => 1];
//});
//
////测试
Route::get('/test', function () {
    echo phpinfo();
});
////    \Illuminate\Support\Facades\Log::info('记录一条日志');
////    \Illuminate\Support\Facades\Log::info('记录一条日志,加点参数', ['name' => 'Alex']);
//
//    $message='这是一条测试日志';
////    \Illuminate\Support\Facades\Log::debug($message);
////    \Illuminate\Support\Facades\Log::channel('errorlog')->info($message);
////    \Illuminate\Support\Facades\Log::stack(['daily','errorlog'])->info($message);
//    \Illuminate\Support\Facades\Log::channel('custom')->info($message);
//});


//
////dojos 道场
Route::resource('dojos', DojoController::class);

//ninjas 忍者
Route::middleware(['alert.messages'])->get('/ninjas', [NinjaController::class, 'index'])->name('ninjas.index');
Route::post('/ninjas', [NinjaController::class, 'store'])->name('ninjas.store');
Route::get('/ninjas/create', [NinjaController::class, 'create'])->name('ninjas.create');
Route::get('/ninjas/{ninja}', [NinjaController::class, 'show'])->name('ninjas.show');
//路由模型绑定
Route::put('/ninjas/{ninja}', [NinjaController::class, 'update'])->name('ninjas.update');
Route::delete('/ninjas/{ninja}', [NinjaController::class, 'destroy'])->name('ninjas.destroy');
Route::get('/ninjas/{ninja}/edit', [NinjaController::class, 'edit'])->name('ninjas.edit');

Route::get('/ninja/delete/{id}', [NinjaController::class, 'delete'])->name('ninja.delete');
//Route::delete('/ninja/{id}', [NinjaController::class, 'destroy'])->name('ninja.destroy');
//ninjas

//books 秘籍
Route::middleware(['log.user.actions'])->resource('books', BookController::class);
//GET|HEAD        books ......................books.index › BookController@index
//POST            books ......................books.store › BookController@store
//GET|HEAD        books/create ...............books.create › BookController@create
//GET|HEAD        books/{book} ...............books.show › BookController@show
//PUT|PATCH       books/{book} ...............books.update › BookController@update
//DELETE          books/{book} ...............books.destroy › BookController@destroy
//GET|HEAD        books/{book}/edit ..........books.edit › BookController@edit

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

////图片上传
//Route::get('/images', [App\Http\Controllers\ImageUploadController::class, 'index'])->name('images.index');
//Route::post('/images', [App\Http\Controllers\ImageUploadController::class, 'upload'])->name('images.upload');
////图片上传
