<?php

namespace App\Http\Controllers;

use App\customers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


class CustomersController extends Controller
{
    //
    protected $redirectTo = '/customers';

    public function index()
    {
        $customers = customers::paginate(10);

        return view('customers/index', ['customers' => $customers]);
    }

    public function create()
    {
        return view('customers/create');
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
        customers::create([
            'customer_name' => $request['customer_name'],
            'customer_address' => $request['customer_address'],
            'customer_mobile' => $request['customer_mobile'],
            'user_create' => Auth::user()->name,
            'user_last_update' => Auth::user()->name
        ]);

        return redirect()->intended('/customers');
    }

    public function edit($id)
    {
        $customers = customers::find($id);
        // Redirect to user list if updating user wasn't existed
        if ($customers == null || $customers->count() == 0) {
            return redirect()->intended('/customers');
        }

        return view('customers/edit', ['customers' => $customers]);
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
        $customers = customers::findOrFail($id);

        $constraints = [
            'customer_name' => 'required',
            'customer_address' => 'required',
            'customer_mobile' => 'required',
        ];

        $input = [
            'customer_name' => $request['customer_name'],
            'customer_address' => $request['customer_address'],
            'customer_mobile' => $request['customer_mobile'],
            'user_last_update' => Auth::user()->name
        ];
        $this->validate($request, $constraints);
        customers::where('id', $id)
            ->update($input);

        return redirect()->intended('/customers');
    }

    public function destroy($id)
    {
        customers::where('id', $id)->delete();
        return redirect()->intended('/customers');
    }

    public function search(Request $request) {
        $constraints = [
            'customer_name' => $request['الاسم'],
            'customer_address' => $request['الرقمالوطني'],
            'customer_mobile' => $request['رقمالجوال']
        ];
        $customers = $this->doSearchingQuery($constraints);

        return view('customers/index', ['customers' => $customers, 'searchingVals' => $constraints]);
    }

    private function doSearchingQuery($constraints) {
        $query = customers::query();
        $fields = array_keys($constraints);
        $index = 0;
        foreach ($constraints as $constraint) {
            if ($constraint != null) {
                $query = $query->where( $fields[$index], 'like', '%'.$constraint.'%');
            }

            $index++;
        }
        return $query->paginate(10);
    }
    private function validateInput($request) {
        $this->validate($request, [
            'customer_name' => 'required',
            'customer_address' => 'required',
            'customer_mobile' => 'required|number',
        ]);
    }
}
