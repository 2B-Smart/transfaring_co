<?php

namespace App\Http\Controllers;

use App\receipts;
use App\customers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReceiptsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $receipts = receipts::orderBy('id')->orderByDesc('bill_id')->paginate(10);

        return view('receipts/index', ['receipts' => $receipts]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param \App\receipts $receipts
     * @return \Illuminate\Http\Response
     */
    public function show(receipts $receipts)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\receipts $receipts
     * @return \Illuminate\Http\Response
     */
    public function edit(receipts $receipts)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\receipts $receipts
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, receipts $receipts)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\receipts $receipts
     * @return \Illuminate\Http\Response
     */
    public function destroy(receipts $receipts)
    {
        //
    }
    public function search(Request $request) {

        $constraints = [
            'receipts_date' => $request['تاريخالايصال'],
            'id' => $request['رقمالايصال'],
            'bill_id' => $request['رقمالمانيفست'],
            'source_city' => $request['المصدر'],
            'destination_city' => $request['الوجهة'],
            'sender' => $request['المرسل'],
            'receiver' => $request['المرسلإليه']
        ];
        $receipts = $this->doSearchingQuery($constraints);
        return view('receipts/index', ['receipts' => $receipts, 'searchingVals' => $constraints]);
    }

    private function doSearchingQuery($constraints) {
        $query = receipts::query();
        $fields = array_keys($constraints);
        $index = 0;
        foreach ($constraints as $constraint) {
            if ($constraint != null) {
                if($fields[$index]=='sender'){
                    $customers=customers::where('customer_name', 'like', '%' . $constraint . '%')->get();
                    $customersIds=[];
                    foreach($customers as $c){
                        $customersIds[] = $c->id;
                    }
//                    print_r($driverIds);
                    $ScIDs =implode(",",$customersIds);
//                    echo $dIDs;
//                    die();
                    //$query = $query->where('driver_id', 'in', $driverIds);
                    $query = $query->whereIn('sender', [$ScIDs]);

                }
                elseif($fields[$index]=='receiver'){
                    $customers=customers::where('customer_name', 'like', '%' . $constraint . '%')->get();
                    $customersIds=[];
                    foreach($customers as $c){
                        $customersIds[] = $c->id;
                    }
//                    print_r($driverIds);
                    $ScIDs =implode(",",$customersIds);
//                    echo $dIDs;
//                    die();
                    //$query = $query->where('driver_id', 'in', $driverIds);
                    $query = $query->whereIn('receiver', [$ScIDs]);
                }
                else {
                    $query = $query->where($fields[$index], 'like', '%' . $constraint . '%');
                }
            }

            $index++;
        }
        return $query->orderBy('id')->orderByDesc('bill_id')->paginate(10);
    }

    private function validateInput($request) {
        $this->validate($request, [
            'source_city' => 'required',
            'destination_city' => 'required',
            'driver_id' => 'required',
            'v_number' => 'required',
        ]);
    }
}
