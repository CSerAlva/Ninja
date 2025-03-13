<?php

namespace Tests\Unit;

use App\Models\MTest_Zy;
use PHPUnit\Framework\TestCase;

class CulTest extends TestCase //Zy
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_example()
    {
//        $this->assertTrue(true);
        $this->assertEquals(3, MTest_Zy::testCulAdd(1, 2)); //断言成功的情况
    }

    public function test_example2()
    {
//        $this->assertEquals(4, MTest::testCulAdd(1, 2)); //断言失败的情况
        $this->assertNotEquals(4, MTest_Zy::testCulAdd(1, 2)); //不相等
    }
}
