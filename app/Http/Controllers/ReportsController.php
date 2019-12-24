<?php

namespace App\Http\Controllers;

use App\bills;
use App\cars;
use App\cities;
use App\receipts;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReportsController extends Controller
{
    //
    public function bill_no_report($id)
    {
        $bills = bills::find($id);
        if ($bills == null || $bills->count() == 0) {
            return redirect()->intended('/bills');
        }

        return view('reports.bill_no_report', [
            'bills' => $bills,
        ]);
    }
    public function receipt($id)
    {
        $receipts = receipts::find($id);
        if ($receipts == null || $receipts->count() == 0) {
            return redirect()->intended('/receipts');
        }

        return view('reports.receipt', [
            'receipts' => $receipts,
        ]);
    }
    public function destination()
    {
        $cities = DB::table('cities')->get();
        if ($cities == null || $cities->count() == 0) {
            return redirect()->intended('/cities');
        }

        return view('reports.destination', [
            'cities' => $cities,
        ]);
    }
    public function destinationRp(Request $request)
    {
        $bills = bills::where('destination_city', '=', $request['destination_city'])->whereBetween('bill_date', [$request['start_date'], $request['end_date']])->get();
        //print_r($bills);
        return view('reports.destinationRp', [
            'bills' => $bills,
            'destination'=>$request['destination_city'],
        ]);
    }
    public function driver()
    {
        $drivers = DB::table('drivers')->get();
        if ($drivers == null || $drivers->count() == 0) {
            return redirect()->intended('/cities');
        }

        return view('reports.driver', [
            'drivers' => $drivers,
        ]);
    }
    public function driverRp(Request $request)
    {
        $bills = bills::where('driver_id', '=', $request['driver'])->whereBetween('bill_date', [$request['start_date'], $request['end_date']])->get();
        //print_r($bills);
        return view('reports.driverRp', [
            'bills' => $bills,
            'driver'=>$request['driver'],
        ]);
    }
}
