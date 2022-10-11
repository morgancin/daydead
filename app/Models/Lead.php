<?php

namespace App\Models;

//use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Lead extends Model
{
    //use HasFactory;
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'phone',
        'email',
        'qr_id',
        'time_capture',
    ];

    ////////////RELATIONSHIPS
    public function qr(): BelongsTo
    {
        return $this->belongsTo(Qr::class, 'qr_id', 'id');
    }
}
