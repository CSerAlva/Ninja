<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ZyBlogTest extends TestCase //Zy
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_example()
    {
        $response = $this->get('/');
        $response->assertStatus(200);
    }

    public function test_example2()
    {
        $response = $this->post('/test/post');
        $response->assertStatus(200);
        $response->dump(); //自己添加的
    }

    public function test_example3()
    {
        $response = $this->postJson('/test/post/json');
        $response->assertStatus(200)->assertJson(['a' => 1]);
    }

    public function test_example4()
    {
        $view = $this->view('test.test', ['message' => 'ZyBlog']);
        $view->assertSee('ZyBlog');
    }

//测试命令行脚本
    public function test_console()
    {
        $this->artisan('testConsole')->expectsOutput("Hello ZyBlog")->assertExitCode(0); //退出代码是0
    }

    public function test_console2()
    {
        $this->artisan('question')
            ->expectsQuestion("选择午餐", "面条")
            ->expectsOutput("你的选择是：面条")
            ->doesntExpectOutput("你的选择是：米饭")
//            ->assertExitCode(1);
            ->assertSuccessful();
    }
}
