<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Value extends Model
{
    use HasFactory;

    protected $fillable = [
        'sample_id',
        'x',
        'y',
    ];

    public function sample()
    {
        return $this->belongsTo(Sample::class);
    }
}
