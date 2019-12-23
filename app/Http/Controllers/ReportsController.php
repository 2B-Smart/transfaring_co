<?php

namespace App\Http\Controllers;

use App\bills;
use App\receipts;
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
}
