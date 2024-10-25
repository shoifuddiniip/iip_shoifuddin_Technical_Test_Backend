<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Survey extends Model
{
    use HasFactory;

    protected $fillable = [
        'lead_id',
        'status',
        'feedback',
        'image', // Include the image field
    ];

    public function lead()
    {
        return $this->belongsTo(Leads::class);
    }
}
