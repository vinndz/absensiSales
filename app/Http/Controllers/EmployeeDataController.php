<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB; // Import DB facade
use Illuminate\Support\Facades\Storage;


class EmployeeDataController extends Controller
{
    public function index()
    {
        return view('employee-data');
    }

    public function dataTable()
    {
        $data = DB::table('employee')->select('manPowerId', 'manPowerName', 'dealerCode', 'dealerName', 'dealerGroupName')->get();

        return response()->json(['data' => $data]);
    }

    public function store(Request $request)
    {
        // Validate the request
        $validated = $request->validate([
            'manPowerId' => 'required|string|max:255',
            'manPowerName' => 'required|string|max:255',
            'dealerCode' => 'required|string|max:255',
            'dealerName' => 'required|string|max:255',
            'dealerGroupName' => 'required|string|max:255',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // Validate image
        ]);

        // Handle the uploaded image
        $imagePath = null;
        if ($request->hasFile('image')) {
            // Store the image in the 'public/images' directory
            $imagePath = $request->file('image')->store('images', 'public');
        }

        // Insert data into the database using DB facade
        DB::table('employee')->insert([  // Change 'employee' to 'employees'
            'manPowerId' => $validated['manPowerId'], // Use validated data
            'manPowerName' => $validated['manPowerName'],
            'dealerCode' => $validated['dealerCode'],
            'dealerName' => $validated['dealerName'],
            'dealerGroupName' => $validated['dealerGroupName'],
            'image' => $imagePath, // Save the image path
            'created_at' => now(),
            'updated_at' => now(),
        ]);
       return redirect()->back()
                        ->with('success', 'Employee data has been saved!')
                        ->with('image', $imagePath);

        // // Pass the image path to the session for use in the view or redirect with success message
        // return redirect()->back()->with('success', 'Employee data has been saved!')
        //                         ->with('image', $imagePath); // Store image path in session
    }
}
