<?php

namespace App\Models;

//use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Qr extends Model
{
    //use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'src',
        'hash',
        'user_id',
        'place_id',
    ];

    protected static function boot(){
        parent::boot();
        self::creating(function(Qr $oQr){
            $oQr->user_id = auth()->id();
        });
    }
}
