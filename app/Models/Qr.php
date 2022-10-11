<?php

namespace App\Models;

//use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Qr extends Model
{
    //use HasFactory;
    use SoftDeletes;

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

    ////////////RELATIONSHIPS
    public function leads(): HasMany
    {
        return $this->hasMany(Lead::class, 'qr_id', 'id');
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function place(): BelongsTo
    {
        return $this->belongsTo(Place::class, 'place_id', 'id');
    }

    ////SCOPES
	public function scopeSearchList($query, $cSearch)
    {
        if($cSearch !== null)
            return $query->where('user_id', 'LIKE', "%$cSearch%")
                        ->orWhere('place_id','LIKE',"%$cSearch%");
        else
            return $query;
    }
}
