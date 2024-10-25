<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Carbon;
class UsersController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    protected $restrictionDuration = 60; // Duration in minutes

    // Restrict a salesperson
    public function restrict($id)
    {
        $sales = User::findOrFail($id);
        $sales->update(['can_receive' => false, 'restriction_time' => now()]);

        return response()->json(['message' => 'Salesperson restricted'], 200);
    }

    // Automatically lift restrictions if the duration has passed
    public function checkAndLiftRestrictions()
    {
        $salespersons = User::where('can_receive', false)->get();

        foreach ($salespersons as $sales) {
            if ($sales->restriction_time && Carbon::now()->diffInMinutes($sales->restriction_time) >= $this->restrictionDuration) {
                $sales->update(['can_receive' => true, 'restriction_time' => null]);
            }
        }

        return response()->json(['message' => 'Checked for restrictions and lifted where applicable'], 200);
    }
}
