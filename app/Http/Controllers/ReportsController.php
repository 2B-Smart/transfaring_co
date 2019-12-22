<?php

namespace App\Http\Controllers;

use App\bills;
use Illuminate\Http\Request;

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
}
