<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Gift extends Model
{
    protected $fillable = [
        'name',
        'expected_value',
        'spent_value',
        'user_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
