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

    ///SCOPES
    public function scopeSearchListBusiness($query, $cSearch)
    {
        if($cSearch !== null)
            return $query->where('businessline', $cSearch);
        else
            return $query;
    }

    public function scopeSearchListPlace($query, $cSearch)
    {
        if($cSearch !== null)
            return $query->whereHas('place', function($q) use($cSearch) {
                $q->where('name', 'LIKE', "%$cSearch%");
            });
        else
            return $query;
    }

    public function scopeSearchList($query, $cSearch)
    {
        if($cSearch !== null)
            return $query->whereHas('qr', function($q) use($cSearch)
                    {
                        $q->whereHas('user', function($q2) use($cSearch)
                        {
                            $q2->where('name', 'LIKE', "%$cSearch%");
                        });
                    });
        else
            return $query;
    }

    public function scopeSearchDates($query, $cSearchFchI, $cSearchFchF)
    {
        if($cSearchFchI !== null && $cSearchFchF !== null)
            return $query->whereRaw(
                "(DATE(created_at) >= ? AND DATE(created_at) <= ?)",
                [
                    $cSearchFchI,
                    $cSearchFchF
                ]
            );

        else
            return $query;
    }
}
