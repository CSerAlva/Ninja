<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Notifications\Notifiable;

class Ninja extends Model
{
    protected $fillable = ['name', 'dojo_id', 'status', 'skill', 'bio', 'email'];

    /** @use HasFactory<\Database\Factories\NinjaFactory> */
//    use HasFactory, Notifiable, HasApiTokens;
    use HasFactory, Notifiable;

    //*一位忍者 只属于 一个道场
    public function dojo()
    {
        return $this->belongsTo(Dojo::class);
    }
}
