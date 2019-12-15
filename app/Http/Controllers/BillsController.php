<?php

namespace App\Http\Controllers;

use App\bills;
use App\drivers;
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
        return view('bills/create');
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
        drivers::create([
            'full_name' => $request['full_name'],
            'customer_name' => $request['customer_name'],
            'national_id_number' => $request['national_id_number'],
            'mobile_number' => $request['mobile_number'],
            'user_create' => Auth::user()->name,
            'user_last_update' => Auth::user()->name
        ]);

        return redirect()->intended('/bills');
    }

    public function edit($id)
    {
        $drivers = drivers::find($id);
        // Redirect to user list if updating user wasn't existed
        if ($drivers == null || $drivers->count() == 0) {
            return redirect()->intended('/drivers');
        }

        return view('drivers/edit', ['drivers' => $drivers]);
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
        $drivers = drivers::findOrFail($id);
        $constraints = [];
        if($drivers->national_id_number!=$request['national_id_number']){
            $constraints = [
                'full_name' => 'required',
                'national_id_number' => 'required|max:20|unique:drivers',
                'mobile_number' => 'required',
            ];
        }else{
            $constraints = [
                'full_name' => 'required',
                'national_id_number' => 'required|max:20',
                'mobile_number' => 'required',
            ];
        }
        $input = [
            //'username' => $request['username'],
            'full_name' => $request['full_name'],
            'national_id_number' => $request['national_id_number'],
            'mobile_number' => $request['mobile_number'],
            'user_last_update' => Auth::user()->name
        ];
        $this->validate($request, $constraints);
        drivers::where('id', $id)
            ->update($input);

        return redirect()->intended('/drivers');
    }

    public function destroy($id)
    {
        drivers::where('id', $id)->delete();
        return redirect()->intended('/drivers');
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
            'full_name' => 'required',
            'national_id_number' => 'required|max:20|unique:drivers',
            'mobile_number' => 'required',
        ]);
    }


}
