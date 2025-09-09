<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class AbsensiController extends Controller
{
    public function index()
    {
        // Dummy data
        $sales = 85;
        $activeCheckins = 10;
        $totalDealers = 4;
        $fullCapacity = 1;

        // Dealer data
        $dealers = [
            ['name' => 'Dealer Jakarta Pusat', 'code' => 'DLR001', 'checkins' => 2, 'totalSales' => 2, 'status' => 'active', 'lastCheckedIn' => '10:30'],
            ['name' => 'Dealer Surabaya', 'code' => 'DLR002', 'checkins' => 4, 'totalSales' => 4, 'status' => 'Full', 'lastCheckedIn' => '09:15'],
            ['name' => 'Dealer Bandung', 'code' => 'DLR003', 'checkins' => 1, 'totalSales' => 1, 'status' => 'active', 'lastCheckedIn' => '11:20'],
            ['name' => 'Dealer Medan', 'code' => 'DLR004', 'checkins' => 3, 'totalSales' => 3, 'status' => 'active', 'lastCheckedIn' => '08:45'],
        ];

        return view('index', compact('sales', 'activeCheckins', 'totalDealers', 'fullCapacity', 'dealers'));
    }

    public function storeManual(Request $request)
    {
        $request->validate([
            'manPower' => 'required'
        ]);

        $employee = DB::table('employee')
            ->where('manPowerId', $request->manPower)
            ->first();

        if (!$employee) {
            return redirect()->back()->with('error', 'Man Power not found.');
        }

        DB::table('sales_attendance')->insert([
            'employeeId' => $employee->id,
            'checkIn' => now(),
            'checkOut' => null
        ]);

        return redirect()->back()->with('success', 'Check-in successful!');
    }

    public function getEmployee($manPowerId)
    {
        $employee = DB::table('employee')
            ->where('manPowerId', $manPowerId)
            ->first();

        if (!$employee) {
            return response()->json(['error' => 'Employee not found.'], 404);
        }

        return response()->json($employee);
    }

    public function dataTable()
    {
        $data = DB::table('sales_attendance')
                    ->join('employee', 'sales_attendance.employeeId', '=', 'employee.id')
                    ->select(
                        'employee.manPowerId',
                        'employee.manPowerName',
                        'employee.dealerCode',
                        'employee.dealerName',
                        'employee.dealerGroupName',
                        'sales_attendance.checkIn',
                        'sales_attendance.checkOut'
                    )
                    ->get()
                    ->map(function ($item) {
                        $item->checkIn = $item->checkIn ? Carbon::parse($item->checkIn)->format('d-m-Y H:i:s') : null;
                        $item->checkOut = $item->checkOut ? Carbon::parse($item->checkOut)->format('d-m-Y H:i:s') : null;
                        return $item;
                    });
        return response()->json(['data' => $data]);
    }

    public function checkIn(Request $request)
    {
        $request->validate([
            'employeeId' => 'required|integer'
        ]);

        DB::table('sales_attendance')->insert([
            'employeeId' => $request->employeeId,
            'checkIn' => now(),
            'checkOut' => null
        ]);

        return redirect()->back()
                        ->with('success', 'Success Check In!');

    }


    public function checkOut(Request $request)
    {
        dd($request->all());
        // Proses check-out berdasarkan ID pegawai
        $attendance = DB::table('sales_attendance')->where('employee_id', $request->id)
                                    ->whereDate('created_at', now()->toDateString())
                                    ->first();

                                    dd($attendance);

        if ($attendance) {
            $attendance->check_out_time = now();
            $attendance->save();

            return response()->json(['success' => true, 'message' => 'Check Out berhasil!']);
        }

        return response()->json(['success' => false, 'message' => 'Attendance not found or already checked out']);
    }

    
}
