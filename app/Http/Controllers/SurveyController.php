<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;
use App\Models\Survey;

class SurveyController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    public function uploadFile(Request $request, $id)
    {
        $request->validate([
            'feedback' => 'nullable|string',
            'image' => [
                'required',
                File::types(['jpeg', 'png', 'jpg', 'svg', 'webp']),
            ],
        ]);

        $survey = Survey::findOrFail($id);

        $getUUID = Str::uuid();
        $fileName = $getUUID . '-file-survey.' . $request->file('image')->getClientOriginalExtension();
        Storage::put('public/' . $fileName, $request->file('image'));

        $survey->image = 'public/' . $fileName;
        $survey->status = 'upload';
        $survey->save();

        return response()->json([
            'status_code' => 200,
            'status' => 'success',
            'data' => null,
        ]);
    }
}
