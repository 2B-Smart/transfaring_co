<?php

namespace App\Http\Controllers;

use App\drivers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DriversController extends Controller
{
    //
    protected $redirectTo = '/drivers';

    public function index()
    {
        $drivers = drivers::take(100)->get();

        return view('drivers/index', ['drivers' => $drivers]);
    }

    public function create()
    {
        return view('drivers/create');
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

        return redirect()->intended('/drivers');
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
        try{
            drivers::where('id', $id)->delete();
        }catch (\Exception $e){
            return redirect()->intended('errorshandler/connot_do_this');
        }
        return redirect()->intended('/drivers');
    }

    public function search(Request $request) {
        $constraints = [
            'full_name' => $request['الاسم'],
            'national_id_number' => $request['الرقمالوطني'],
            'mobile_number' => $request['رقمالجوال']
        ];
        $drivers = $this->doSearchingQuery($constraints);

        return view('drivers/index', ['drivers' => $drivers, 'searchingVals' => $constraints]);
    }

    private function doSearchingQuery($constraints) {
        $query = drivers::query();
        $fields = array_keys($constraints);
        $index = 0;
        foreach ($constraints as $constraint) {
            if ($constraint != null) {
                $query = $query->where( $fields[$index], 'like', '%'.$constraint.'%');
            }

            $index++;
        }
        return $query->get();
    }
    private function validateInput($request) {
        $this->validate($request, [
            'full_name' => 'required',
            'national_id_number' => 'required|max:20|unique:drivers',
            'mobile_number' => 'required',
        ]);
    }
}
