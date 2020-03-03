<?php

namespace App\Http\Controllers;

use App\bills;
use App\cars;
use App\cities;
use App\customers;
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
    public function connot_do_this(){
        return view('errorshandler.connot_do_this');
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

    public function sender()
    {
        $customers = DB::table('customers')->get();
        if ($customers == null || $customers->count() == 0) {
            return redirect()->intended('/customers');
        }

        return view('reports.sender', [
            'customers' => $customers,
        ]);
    }
    public function senderRp(Request $request)
    {
        $receipts = receipts::where('sender', '=', $request['sender'])->whereBetween('receipts_date', [$request['start_date'], $request['end_date']])->get();
        $sender=customers::where('id',$request['sender'])->first();
        //print_r($bills);
        return view('reports.senderRp', [
            'receipts' => $receipts,
            'sender'=>$sender->customer_name,
        ]);
    }

    public function receiver()
    {
        $customers = DB::table('customers')->get();
        if ($customers == null || $customers->count() == 0) {
            return redirect()->intended('/customers');
        }

        return view('reports.receiver', [
            'customers' => $customers,
        ]);
    }
    public function receiverRp(Request $request)
    {
        $receipts = receipts::where('receiver', '=', $request['receiver'])->whereBetween('receipts_date', [$request['start_date'], $request['end_date']])->get();
        $receiver=customers::where('id',$request['receiver'])->first();
        //print_r($bills);
        return view('reports.receiverRp', [
            'receipts' => $receipts,
            'receiver'=>$receiver->customer_name,
        ]);
    }

    public function car()
    {
        $cars = DB::table('cars')->get();
        if ($cars == null || $cars->count() == 0) {
            return redirect()->intended('/cars');
        }

        return view('reports.car', [
            'cars' => $cars,
        ]);
    }
    public function carRp(Request $request)
    {
        $bills = bills::where('v_number', '=', $request['v_number'])->whereBetween('bill_date', [$request['start_date'], $request['end_date']])->get();
        $car=cars::where('vehicle_number',$request['v_number'])->first();
        return view('reports.carRp', [
            'bills' => $bills,
            'car'=>$car->vehicle_type.' - '.$car->vehicle_number,
        ]);
    }
    public function receipt_paid()
    {
        $cities_list = DB::table('cities')->get();
        return view('reports.receipt_paid',[
            'cities_list'=>$cities_list,
        ]);
    }
    public function receipt_paidRp(Request $request)
    {
        if($request['city']=="all"){
            $receipts = receipts::whereBetween('receipts_date', [$request['start_date'], $request['end_date']])->where('remittances','<>',null)->where('remittances','>',0)->orderBy('id')->orderByDesc('receipts_date')->orderByDesc('paid_date')->get();
            return view('reports.receipt_paidRp', [
                'receipts' => $receipts,
            ]);
        }else{
            $receipts = receipts::whereBetween('receipts_date', [$request['start_date'], $request['end_date']])->where('remittances','<>',null)->where('remittances','>',0)->where('destination_city','=',$request['city'])->orderBy('id')->orderByDesc('receipts_date')->orderByDesc('paid_date')->get();
            return view('reports.receipt_paidRp', [
                'receipts' => $receipts,
            ]);
        }
    }
    public function receipt_paidF(){
        return view('reports.receipt_paidF');
    }
    public function receipt_paidFRp(Request $request){
        $receipt= receipts::where('receiptNo',$request['receiptNo'])->first();

        return view('reports.receipt_paidFRp', [
            'receipt' => $receipt,
        ]);
    }
}
