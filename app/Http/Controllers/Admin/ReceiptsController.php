<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\Helper;
use App\Http\Controllers\Controller;
use App\Models\Receipt;
use App\Models\Service;
use App\Models\Statistic;
use App\Models\User;
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
        $static = Statistic::paginate(2);
        $user = User::all();
        $service = Service::all();
        return view('admin.Receipts.index',compact('static','user','service'));
    }
    //ajax
    public function date(Request $request){
        $date = $request->day;
        $month = $request->month;
        $year = $request->year;

        if(isset($date) && isset($month) && isset($year)){
            $query = DB::table('statistics')
            ->whereDay('created_at', '=', $date)
            ->whereMonth('created_at', '=', $month)
            ->whereYear('created_at', '=', $year)
            ->sum('price');
            echo $query;
        }else{
            echo "Bạn cần nhập đủ ngày tháng năm !!";
        }
    }
    public function everyday(){
        $static = Statistic::all();
        $price = 0;
        foreach($static as $val){
            $price +=$val['price'];
        }
        echo $price;
    }
    public function topmonth(){
        
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
