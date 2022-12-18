<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Sample extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'user_id',
        'name',
        'chunk',
        'x_intervals',
        'y_intervals',
        'auto_x_intervals',
        'auto_y_intervals',
        'is_public',
    ];

    protected $casts = [
        'is_public' => 'boolean',
        'auto_x_intervals' => 'boolean',
        'auto_y_intervals' => 'boolean',
    ];

    protected $with = [
        'user',
        'values',
    ];

    public function values()
    {
        return $this->hasMany(Value::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
