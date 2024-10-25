<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Leads;
use App\Models\User;
use App\Models\LeadDistributionTracker;

class LeadsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    public function index()
    {
        $leads = Leads::all();
        return response()->json([
            'status_code' => 200,
            'status' => 'success',
            'data' => $leads,
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|string',
            'phone' => 'required|string',
        ]);

        Leads::create([
            'title' => $request->title,
            'description' => $request->description,
        ]);

        return response()->json([
            'status_code' => 200,
            'status' => 'success',
            'data' => null,
        ]);
    }

    public function distribute()
    {
        // Get all unassigned leads
        $leads = Leads::whereNull('assigned_to')->get();

        // Get eligible salespersons (role_id 3 is Salesperson)
        $sales = User::where('role_id', 3)
            ->where('can_receive', true)
            ->pluck('id');

        // Error if no eligible salespersons
        if ($sales->isEmpty()) {
            return response()->json(['error' => 'No eligible salespersons'], 400);
        }

        // Get tracker or create it if not exists
        $tracker = LeadDistributionTracker::firstOrCreate([], ['last_sales_id' => null]);
        $lastId = $tracker->last_sales_id;

        // Find the next eligible salesperson for round-robin
        $currentIndex = $sales->search($lastId);
        $nextIndex = ($currentIndex === false || $currentIndex === $sales->count() - 1) ? 0 : $currentIndex + 1;

        // Assign leads in round-robin
        foreach ($leads as $lead) {
            $salesId = $sales[$nextIndex];
            $lead->update(['assigned_to' => $salesId, 'assigned_at' => now()]); // Assign lead with timestamp

            // Move to the next salesperson
            $nextIndex = ($nextIndex + 1) % $sales->count();
        }

        // Update tracker with the last assigned salesperson
        $tracker->update(['last_sales_id' => $sales[$nextIndex - 1]]);

        return response()->json(['message' => 'Leads distributed successfully'], 200);
    }
}
