<?php

namespace App\Models;

//use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Place extends Model
{
    //use HasFactory;
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'code',
    ];

    ////////////RELATIONSHIPS
    public function qrs(): HasMany
    {
        return $this->hasMany(Qr::class, 'place_id', 'id');
    }

    public function leads(): HasMany
    {
        return $this->hasMany(Lead::class, 'place_id', 'id');
    }

    ////SCOPES
	public function scopeSearchList($query, $cSearch)
    {
        if($cSearch !== null)
            return $query->where('name', 'LIKE', "%$cSearch%")
                        ->orWhere('code','LIKE',"%$cSearch%");
        else
            return $query;
    }
}
