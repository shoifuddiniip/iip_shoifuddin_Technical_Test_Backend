<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LeadDistributionTracker extends Model
{
    protected $fillable = ['last_assigned_salesperson_id'];
}