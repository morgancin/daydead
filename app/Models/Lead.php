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
        'place_id',
        'businessline',
        'time_capture',
    ];

    ////////////RELATIONSHIPS
    public function qr(): BelongsTo
    {
        return $this->belongsTo(Qr::class, 'qr_id', 'id');
    }

    public function place(): BelongsTo
    {
        return $this->belongsTo(Place::class, 'place_id', 'id');
    }

    ////////////ACCESSORS
    public function getBusinessLineTextAttribute()
    {
        $cBusinessline = '';

        if($this->businessline == 'SG')
            $cBusinessline = 'SANTA GLORIA';

        elseif($this->businessline == 'BF')
            $cBusinessline = 'BYE BYE FRIEND';

        elseif($this->businessline == 'PF')
            $cBusinessline = 'PREVENCIÓN FINAL';

        return $cBusinessline;
    }
}
