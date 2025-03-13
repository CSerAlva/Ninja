<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MTest_Zy extends Model  //Zy
{
    public static function testCulAdd($a, $b)
    {
        return $a + $b;
    }
}
