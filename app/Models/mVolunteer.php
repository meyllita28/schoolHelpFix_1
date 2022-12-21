<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Database\Eloquent\SoftDeletes;

class mVolunteer extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $dates = ['deleted_at'];
    protected $table = 'volunteer';
    protected $primaryKey = 'id_volunteer';
    protected $fillable = [
        'vol_name',
        'vol_phone_no',
        'vol_birth_date',
        'vol_address',
        'vol_email',
    ];

    public function getUpdatedAtAttribute()
    {
        return \Carbon\Carbon::parse($this->attributes['updated_at'])
            ->diffForHumans();
    }

    public function scopeWhereLike($query, $column, $value)
    {
        return $query->where($column, 'LIKE', '%' . $value . '%');
    }

    public function scopeOrWhereLike($query, $column, $value)
    {
        return $query->orWhere($column, 'LIKE', '%' . $value . '%');
    }
}
