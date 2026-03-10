<?php

namespace App\Http\Controllers;

use App\Models\Schedule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ScheduleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $schedule = Schedule::all();
        return response()->json($schedule, 200);
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name'        => 'required|string',
            'description' => 'nullable|string',
            'date'        => 'required|date',
            'time'        => 'required|date_format:H:i:s',
            'category'    => 'required|string',
        ]);
    
        if ($validator->fails()) {
            return response()->json([
                'message' => 'Validation Error',
                'errors'  => $validator->errors()
            ], 422);
        }
    
        $schedule = Schedule::create([
            'name'        => $request->name,
            'description' => $request->description,
            'date'        => $request->date,
            'time'        => $request->time,
            'category'    => $request->category,
        ]);
    
        return response()->json($schedule, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $schedule = Schedule::find($id);
        return response()->json($schedule, 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        //
        $schedule = Schedule::find($id);

        if(!$schedule){
            return response()->json(['message' => 'Data Tidak Ditemukan'],404);
        }

        $validated = $request->validate([
            'name'        => 'required|string',
            'description' => 'nullable|string',
            'date'        => 'required|date',
            'time'        => 'required|date_format:H:i:s',
            'category'    => 'required|string',
        ]);

        $schedule->update($validated);

        return response()->json([
            'message' => 'Schedule updated succesfully',
            'data' => $schedule
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        Schedule::destroy($id);
        return response()->json(null, 204);
    }
}
