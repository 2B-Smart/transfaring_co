<?php

namespace App\Http\Controllers;

use App\bills;
use App\drivers;
use App\receipts;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class BillsController extends Controller
{
    //
    protected $redirectTo = '/bills';

    public function index()
    {
        $bills = bills::orderBy('has_done')->orderByDesc('id')->paginate(10);

        return view('bills/index', ['bills' => $bills]);
    }

    public function create()
    {
        $drivers_list = DB::table('drivers')->orderBy('full_name')->get();
        $cities_list = DB::table('cities')->get();
        $cars_list = DB::table('cars')->get();

        return view('bills.create', [
            'drivers_list' => $drivers_list,
            'cities_list' => $cities_list,
            'cars_list' => $cars_list,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validateInput($request);
        bills::create([
            'bill_date' => date('Y-m-d'),
            'source_city' => $request['source_city'],
            'has_done' => "غير مقفلة",
            'destination_city' => $request['destination_city'],
            'driver_id' => $request['driver_id'],
            'v_number' => $request['v_number'],
            'user_create' => Auth::user()->name,
            'user_last_update' => Auth::user()->name
        ]);

        return redirect()->intended('/bills');
    }
    public function view($id){
        $bills = bills::find($id);
        // Redirect to user list if updating user wasn't existed
        if ($bills == null || $bills->count() == 0) {
            return redirect()->intended('/bills');
        }

        $customers_list = DB::table('customers')->orderBy('customer_name')->get();
//        $cities_list = DB::table('cities')->get();
//        $cars_list = DB::table('cars')->get();

//        print_r($bills->receipts);
//        die();

        return view('bills.view', [
            'bills' => $bills,
            'customers_list' => $customers_list,
        ]);
    }
    public function addrec(Request $request){

        $bill = bills::find($request['bill_id']);
        $receipts=receipts::create([
            'receiptNo'=>$request['receiptNo'],
            'sender'=>$request['sender'],
            'receiver'=>$request['receiver'],
            'source_city'=>$bill->source_city,
            'destination_city'=>$bill->destination_city,
            'number_of_packages'=>$request['number_of_packages'],
            'package_type'=>$request['package_type'],
            'contents'=>$request['contents'],
            'weight'=>$request['weight'],
            'size'=>$request['size'],
            'marks'=>$request['marks'],
            'notes'=>$request['notes'],
            'prepaid'=>$request['prepaid'],
            'collect_from_receiver'=>$request['collect_from_receiver'],
            'prepaid_miscellaneous'=>$request['prepaid_miscellaneous'],
            'trans_miscellaneous'=>$request['trans_miscellaneous'],
            'remittances'=>$request['remittances'],
            'remittances_paid'=>"غير مدفوع",
            'discount'=>$request['discount'],
            'receipts_date'=>$request['receipts_date'],
            'bill_id'=>$request['bill_id'],
            'user_create' => Auth::user()->name,
            'user_last_update' => Auth::user()->name
        ]);
        //return response($receipts->id);
    }

    public function delrec($id){
        receipts::where('id', $id)->delete();
    }

    public function edit($id)
    {
        $bills = bills::find($id);
        // Redirect to user list if updating user wasn't existed
        if ($bills == null || $bills->count() == 0) {
            return redirect()->intended('/bills');
        }

        $drivers_list = DB::table('drivers')->orderBy('full_name')->get();
        $cities_list = DB::table('cities')->get();
        $cars_list = DB::table('cars')->get();

        return view('bills.edit', [
            'bills' => $bills,
            'drivers_list' => $drivers_list,
            'cities_list' => $cities_list,
            'cars_list' => $cars_list,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $bills = bills::findOrFail($id);
        $constraints = [
            'source_city' => 'required',
            'destination_city' => 'required',
            'driver_id' => 'required',
            'v_number' => 'required',
        ];
        $input = [
            'source_city' => $request['source_city'],
            'destination_city' => $request['destination_city'],
            'driver_id' => $request['driver_id'],
            'v_number' => $request['v_number'],
            'user_last_update' => Auth::user()->name
        ];
        $this->validate($request, $constraints);
        bills::where('id', $id)
            ->update($input);

        return redirect()->intended('/bills');
    }

    public function destroy($id)
    {
        try{
            bills::where('id', $id)->delete();
        }catch (\Exception $e){
            return redirect()->intended('errorshandler/connot_do_this');
        }
        return redirect()->intended('/bills');
    }

    public function billlock($id)
    {
        bills::where('id', $id)
            ->update(['has_done' => "مقفلة",'user_last_update' => Auth::user()->name]);
        return redirect()->intended('/bills');
    }

    public function search(Request $request) {

        $constraints = [
            'bill_date' => $request['تاريخالرحلة'],
            'id' => $request['رقمالرحلة'],
            'driver_id' => $request['اسمالسائق'],
            'source_city' => $request['المصدر'],
            'destination_city' => $request['الوجهة'],
            'v_number' => $request['رقمالمركبة'],
            'has_done' => $request['مقفلة']
        ];
        $bills = $this->doSearchingQuery($constraints);
        return view('bills/index', ['bills' => $bills, 'searchingVals' => $constraints]);
    }

    private function doSearchingQuery($constraints) {
        $query = bills::query();
        $fields = array_keys($constraints);
        $index = 0;
        foreach ($constraints as $constraint) {
            if ($constraint != null) {
                if($fields[$index]=='driver_id'){
                    $driver=drivers::where('full_name', 'like', '%' . $constraint . '%')->get();
                    $driverIds=[];
                    foreach($driver as $d){
                        $driverIds[] = $d->id;
                    }
//                    print_r($driverIds);
                    $dIDs =implode(",",$driverIds);
//                    echo $dIDs;
//                    die();
                    //$query = $query->where('driver_id', 'in', $driverIds);
                    $query = $query->whereIn('driver_id', [$dIDs]);

                }else {
                    $query = $query->where($fields[$index], 'like', '%' . $constraint . '%');
                }
            }

            $index++;
        }
        return $query->orderBy('has_done')->orderByDesc('id')->paginate(10);
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
