<?php

namespace App\Http\Controllers;

use App\cities;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\PDF;

class CitiesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    protected $redirectTo = '/cities';
    public function index()
    {
        $cities = cities::paginate(10);

        return view('cities/index', ['cities' => $cities]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('cities/create');
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
        cities::create([
            'city_name' => $request['city_name'],
            'user_create' => Auth::user()->name,
            'user_last_update' => Auth::user()->name
        ]);

        return redirect()->intended('/cities');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\cities  $cities
     * @return \Illuminate\Http\Response
     */
    public function show(cities $cities)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\cities  $cities
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $cities = cities::where('city_name', $id)->first();
        // Redirect to user list if updating user wasn't existed
        if ($cities == null || $cities->count() == 0) {
            return redirect()->intended('/cities');
        }

        return view('cities/edit', ['cities' => $cities]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $cities
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $cities = cities::where('city_name', $id)->first();
        $constraints=[];
        if($cities->city_name!=$request['city_name']){
            $constraints = [
                'city_name' => 'required|unique:cities',
                //'national_id_number' => 'required|max:20|unique:drivers',
            ];
        }else{
            $constraints = [
                'city_name' => 'required',
                //'national_id_number' => 'required|max:20|unique:drivers',
            ];
        }
        $input = [
            //'username' => $request['username'],
            'city_name' => $request['city_name'],
            //'national_id_number' => $request['national_id_number'],
            'user_last_update' => Auth::user()->name
        ];
        $this->validate($request, $constraints);
        cities::where('city_name', $id)
            ->update($input);

        return redirect()->intended('/cities');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\cities  $cities
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        cities::where('city_name', $id)->delete();
        return redirect()->intended('/cities');
    }

    public function search(Request $request) {
        $constraints = [
            'city_name' => $request['اسمالمدينة']
        ];
        $cities = $this->doSearchingQuery($constraints);

        return view('cities/index', ['cities' => $cities, 'searchingVals' => $constraints]);
    }

    private function doSearchingQuery($constraints) {
        $query = cities::query();
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
            'city_name' => 'required|unique:cities',
        ]);
    }
}
