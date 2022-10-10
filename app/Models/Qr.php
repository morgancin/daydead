<?php

namespace App\Models;

//use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

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
        'businessline',
    ];

    /*
    protected static function boot(){
        parent::boot();
        self::creating(function(Qr $oQr){
            $oQr->user_id = auth()->id();
        });
    }
    */

    ////////////RELATION SHIP
    public function lead(): HasOne
    {
        return $this->hasOne(Lead::class, 'qr_id', 'id');
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function place(): BelongsTo
    {
        return $this->belongsTo(Place::class, 'place_id', 'id');
    }
}
