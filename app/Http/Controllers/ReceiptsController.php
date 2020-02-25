<?php

namespace App\Http\Controllers;

use App\bills;
use App\receipts;
use App\customers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
        $receipts = receipts::where('id',null)->orderBy('id')->orderByDesc('bill_id')->get();

        return view('receipts/index', ['receipts' => $receipts]);
    }
    public function unpaid()
    {
        $receipts = receipts::where('remittances_paid','غير مدفوع')->where('remittances','<>',null)
            ->where('remittances','>',0)->orderBy('id')->orderByDesc('receipts_date')->paginate(10);

        return view('receipts/unpaid', ['receipts' => $receipts]);
    }
    public function searchunpaid(Request $request) {

        $constraints = [
            'receipts_date' => $request['تاريخالايصال'],
            'receiptNo' => $request['رقمالايصال'],
            'bill_id' => $request['رقمالمانيفست'],
            'source_city' => $request['المصدر'],
            'destination_city' => $request['الوجهة'],
            'sender' => $request['المرسل'],
            'receiver' => $request['المرسلإليه']
        ];
        $receipts = $this->doSearchingQueryUnpaid($constraints);
        return view('receipts/unpaid', ['receipts' => $receipts, 'searchingVals' => $constraints]);
    }
    private function doSearchingQueryUnpaid($constraints) {
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
        return $query->where('remittances_paid','غير مدفوع')->where('remittances','<>',null)
            ->where('remittances','>',0)->orderBy('id')->orderByDesc('bill_id')->paginate(10);
    }

    public function correction(){
        return view('receipts.correction');
    }
    public function getR(Request $request){

        $receipts = receipts::where('bill_id',$request['bill_id'])->orderBy('id')->get();
        $res="<table class='table'>";
        $res.="<tr><td colspan='12'></td><td><button type='button' class='btn btn-success pull-right mvAR'>نقل الكل</button></td></tr>";
        $res.="<tr>
                <th width='3%' tabindex='0' aria-controls='example2' rowspan='1' colspan='1'>أمر النقل</th>
                <th width='7%' tabindex='0' aria-controls='example2' rowspan='1' colspan='1'>رقم الرحلة</th>
                <th width='8%' tabindex='0' aria-controls='example2' rowspan='1' colspan='1'>رقم الايصال</th>
                <th width='3%' tabindex='0' aria-controls='example2' rowspan='1' colspan='1'>المرسل</th>
                <th width='3%' tabindex='0' aria-controls='example2' rowspan='1' colspan='1'>المرسل اليه</th>
                <th width='3%' tabindex='0' aria-controls='example2' rowspan='1' colspan='1'>المصدر</th>
                <th width='3%' tabindex='0' aria-controls='example2' rowspan='1' colspan='1'>الوجهة</th>
                <th width='10%' tabindex='0' aria-controls='example2' rowspan='1' colspan='1'>تاريخ الايصال</th>
                <th width='10%' tabindex='0' aria-controls='example2' rowspan='1' colspan='1'>المحتويات</th>
                <th width='10%' tabindex='0' aria-controls='example2' rowspan='1' colspan='1'>أنشئ من قبل</th>
                <th width='10%' tabindex='0' aria-controls='example2' rowspan='1' colspan='1'>تاريخ الانشاء</th>
                <th width='10%' tabindex='0' aria-controls='example2' rowspan='1' colspan='1'>اخر تعديل من قبل</th>
                <th width='10%' tabindex='0' aria-controls='example2' rowspan='1' colspan='1'>تاريخ اخر تعديل</th>
            </tr>";
        foreach($receipts as $receipt){
            $res.="<tr id='". $receipt->id ."' >
                  <td><button type='button' id='". $receipt->id ."' class='btn btn-success pull-right mvR'>نقل</button></td>
                  <td>". $receipt->bill_id ."</td>
                  <td>". $receipt->receiptNo ."</td>
                  <td>". $receipt->customer_sender->customer_name ."</td>
                  <td>". $receipt->customer_receiver->customer_name ."</td>
                  <td>". $receipt->source_city ."</td>
                  <td>". $receipt->destination_city ."</td>
                  <td>". $receipt->receipts_date ."</td>
                  <td>". $receipt->contents ."</td>
                  <td>". $receipt->user_create ."</td>
                  <td>". $receipt->created_at ."</td>
                  <td>". $receipt->user_last_update ."</td>
                  <td>". $receipt->updated_at ."</td>
                </tr>";
        }
        $res.="</table>";
        return response($res);
    }
    public function mvR(Request $request){
        $bill = bills::find($request['bill_id']);
        $input = [
            'destination_city'=>$bill->destination_city,
            'bill_id'=>$request['bill_id'],
            'user_last_update' => Auth::user()->name
        ];
        receipts::where('id', $request['ID'])
            ->update($input);
    }

    public function mvAR(Request $request){
        $bill = bills::find($request['bill_id']);
        $bill2 = bills::find($request['bill_id2']);
        foreach($bill->receipts as $receipt){
            $input = [
                'destination_city'=>$bill2->destination_city,
                'bill_id'=>$request['bill_id2'],
                'user_last_update' => Auth::user()->name
            ];
            receipts::where('id', $receipt->id)
                ->update($input);
        }

    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $bills_list = DB::table('bills')->get();
        $cities_list = DB::table('cities')->get();

        return view('receipts.create', [
            'bills_list' => $bills_list,
            'cities_list'=>$cities_list
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
        $bill = bills::find($request['bill_id']);
        receipts::create([
            'receiptNo'=>$request['receiptNo'],
            'sender'=>$request['sender'],
            'receiver'=>$request['receiver'],
            'source_city'=>$request['source_city'],
            'destination_city'=>$bill->destination_city,
            'receipts_date'=>$request['receipts_date'],
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
            'bill_id'=>$request['bill_id'],
            'user_create' => Auth::user()->name,
            'user_last_update' => Auth::user()->name
        ]);
        return redirect()->intended('/receipts');
    }

    /**
     * Display the specified resource.
     *
     * @param \App\receipts $receipts
     * @return \Illuminate\Http\Response
     */
    public function view($id)
    {
        //
        $receipts = receipts::find($id);
        if ($receipts == null || $receipts->count() == 0) {
            return redirect()->intended('/receipts');
        }
        return view('receipts.view', [
            'receipts' => $receipts,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\receipts $receipts
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $receipts = receipts::find($id);
        // Redirect to user list if updating user wasn't existed
        if ($receipts == null || $receipts->count() == 0) {
            return redirect()->intended('/receipts');
        }

        $bills_list = DB::table('bills')->get();
        $sender = DB::table('customers')->where('id',$receipts->sender)->first();
        $receiver = DB::table('customers')->where('id',$receipts->receiver)->first();
        $cities_list = DB::table('cities')->get();

        return view('receipts.edit', [
            'receipts' => $receipts,
            'bills_list' => $bills_list,
            'sender' => $sender,
            'receiver' => $receiver,
            'cities_list'=>$cities_list
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\receipts $receipts
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $receipts = receipts::findOrFail($id);
        $bill = bills::find($request['bill_id']);
        $constraints = [
            'receiptNo'=>'required|max:20',
            'source_city'=>'required',
            'sender'=>'required',
            'receiver'=>'required',
            'receipts_date'=>'required',
            'number_of_packages'=>'required|max:20',
            'package_type'=>'required',
            'contents'=>'required',
            'bill_id'=>'required',
        ];
        $input = [
            'receiptNo'=>$request['receiptNo'],
            'sender'=>$request['sender'],
            'receiver'=>$request['receiver'],
            'source_city'=>$request['source_city'],
            'destination_city'=>$bill->destination_city,
            'receipts_date'=>$request['receipts_date'],
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
            'discount'=>$request['discount'],
            'bill_id'=>$request['bill_id'],
            'user_last_update' => Auth::user()->name
        ];
        $this->validate($request, $constraints);
        receipts::where('id', $id)
            ->update($input);

        return redirect()->intended('/receipts');
    }

    public function haspaid($id)
    {
        $receipts = receipts::findOrFail($id);
        $input = [
            'remittances_paid'=>"مدفوع",
            'paid_date'=> date('Y-m-d'),
            'user_last_update' => Auth::user()->name
        ];
        receipts::where('id', $id)
            ->update($input);
        return redirect()->intended('/receipts/unpaid');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\receipts $receipts
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        receipts::where('id', $id)->delete();
        return redirect()->intended('/receipts');
    }
    public function search(Request $request) {

        $constraints = [
            'receipts_date' => $request['تاريخالايصال'],
            'receiptNo' => $request['رقمالايصال'],
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
        $sqlStatment = "select * from receipts";
        $fields = array_keys($constraints);
        $index = 0;
        $where='';
        $cond=[];
        $order='order by `bill_id` DESC , `id` ASC';
        foreach ($constraints as $constraint) {
            if ($constraint != null) {
                //echo $fields[$index] ."<br>";
                if($fields[$index]=='sender'){
                    $where=' where ';
                    $customers=customers::where('customer_name', 'like', '%' . $constraint . '%')->get();
                    if($customers->count()>0){
                        $customersIds=[];
                        foreach($customers as $c){
                            $customersIds[] = $c->id;
                        }
                        $ScIDs =implode(",",$customersIds);
                        $cond[] =' `sender` in ('.$ScIDs.')';
                    }else{
                        $cond[] =' `sender` is null ';
                    }
                }
                elseif($fields[$index]=='receiver'){
                    $where=' where ';
                    $customers=customers::where('customer_name', 'like', '%' . $constraint . '%')->get();
                    if($customers->count()>0){
                        $customersIds=[];
                        foreach($customers as $c){
                            $customersIds[] = $c->id;
                        }
                        $ScIDs =implode(",",$customersIds);
                        $cond[] =' `receiver` in ('.$ScIDs.')';
                    }else{
                        $cond[] =' `receiver` is null ';
                    }
                }
                elseif($fields[$index]=='receiptNo'||$fields[$index]=='bill_id'){
                    $where=' where ';
                    $cond[] =' `'.$fields[$index].'` = '.$constraint.' ';
                }
                else {
                    $where=' where ';
                    $cond[] =' `'.$fields[$index].'` like "%'.$constraint.'%" ';
                    //$query = $query->where($fields[$index], 'like', '%' . $constraint . '%');
                }
            }

            $index++;
        }
        $conds=implode("and",$cond);
        $sqlStatment .= $where.' '.$conds.' '.$order;
        $query = DB::select($sqlStatment);
        return $query;
        //dd($query);
    }

    private function validateInput($request) {
        $this->validate($request, [
            'receiptNo'=>'required|max:20',
            'source_city'=>'required',
            'sender'=>'required',
            'receiver'=>'required',
            'receipts_date'=>'required',
            'number_of_packages'=>'required|max:20',
            'package_type'=>'required',
            'contents'=>'required',
            'bill_id'=>'required',
        ]);
    }
}
