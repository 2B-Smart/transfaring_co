<?php

namespace App\Http\Controllers;

use App\cars;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\PDF;

class CarsController extends Controller
{
    //
    protected $redirectTo = '/drivers';

    public function index()
    {
        $cars = cars::paginate(10);

        return view('cars/index', ['cars' => $cars]);
    }

    public function create()
    {
        return view('cars/create');
    }
//
//    function pdf()
//    {
//        $pdf = \App::make('dompdf.wrapper');
//        $pdf->loadHTML($this->
//            convert_cars_data_to_html());
//        $pdf->stream();
//    }
//
//    function convert_cars_data_to_html()
//    {
//        $cars_data = $this->get_cars_data();
//        $output = '
//            <h1>test</h1>
//        ';
//        foreach ($cars_data as $car)
//        {
//            $output .= '
//               <h1>.$car->car_name.</h1>
//            ';
//        }
//        $output .= '</table>';
//        return $output;
//    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
//        $request['user_create']=Auth::user()->username;
//        $request['user_last_update']=Auth::user()->username;
        $this->validateInput($request);
        cars::create([
            'vehicle_number' => $request['vehicle_number'],
            'vehicle_type' => $request['vehicle_type'],
            'user_create' => Auth::user()->name,
            'user_last_update' => Auth::user()->name
        ]);

        return redirect()->intended('/cars');
    }

    public function edit($id)
    {
//        $cars = cars::query();
//        $cars = $cars->where( 'vehicle_number', '=', $id);
        $cars = cars::where('vehicle_number', $id)->first();
        // Redirect to user list if updating user wasn't existed
        if ($cars == null || $cars->count() == 0) {
            return redirect()->intended('/cars');
        }

        return view('cars/edit', ['cars' => $cars]);
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
        $cars = cars::where('vehicle_number', $id)->first();
        $constraints=[];
        if($cars->vehicle_number!=$request['vehicle_number']){
            $constraints = [
                'vehicle_number' => 'required|unique:cars',
                //'national_id_number' => 'required|max:20|unique:drivers',
                'vehicle_type' => 'required',
            ];
        }else{
            $constraints = [
                'vehicle_number' => 'required',
                //'national_id_number' => 'required|max:20|unique:drivers',
                'vehicle_type' => 'required',
            ];
        }
        $input = [
            //'username' => $request['username'],
            'vehicle_number' => $request['vehicle_number'],
            //'national_id_number' => $request['national_id_number'],
            'vehicle_type' => $request['vehicle_type'],
            'user_last_update' => Auth::user()->name
        ];
        $this->validate($request, $constraints);
        cars::where('vehicle_number', $id)
            ->update($input);

        return redirect()->intended('/cars');
    }

    public function destroy($id)
    {
        cars::where('vehicle_number', $id)->delete();
        return redirect()->intended('/cars');
    }

    public function search(Request $request) {
        $constraints = [
            'vehicle_number' => $request['رقمالمركبة'],
            'vehicle_type' => $request['نوعالمركبة']
        ];
        $cars = $this->doSearchingQuery($constraints);

        return view('cars/index', ['cars' => $cars, 'searchingVals' => $constraints]);
    }

    private function doSearchingQuery($constraints) {
        $query = cars::query();
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
            'vehicle_number' => 'required|unique:cars',
            'vehicle_type' => 'required',
        ]);
    }
}
