<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Subscription extends Model
{
    protected $fillable = [
        'user_id', 'period_start', 'period_end', 'is_vip',
    ];

    protected $casts = [
        'is_vip' => 'boolean',
        'is_active' => 'boolean',
    ];

    protected $dates = [
        'created_at', 'updated_at', 'period_start', 'period_end',
    ];

    public function user() {
        return $this->belongsTo('App\User', 'user_id');
    }
}
