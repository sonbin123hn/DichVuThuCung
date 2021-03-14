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
        $static = Statistic::paginate(3);
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
            echo $query." VND";
        }
    }
    public function everyday(){
        $static = Statistic::all();
        $price = 0;
        foreach($static as $val){
            $price +=$val['price'];
        }
        echo $price." VND";
    }
    public function topmonth(){
        $query= Statistic::select(DB::raw('MONTH(created_at) as month,Sum(price) AS tongTien'))
        ->groupBy('month')
        ->orderBy('month')
        ->limit(1)->get();
        foreach($query as $val){
            echo "Top month sales is :".$val['month'].", with total :".$val['tongTien']."VND";
        }
    }
    public function topday(){
        $query= Statistic::select(DB::raw('DAY(created_at) as day,Sum(price) AS tongTien'))
        ->groupBy('day')
        ->orderBy('day')
        ->limit(1)->get();
        foreach($query as $val){
            echo "Total sales of day :".$val['day']." is :".$val['tongTien']."VND";
        }
    }
    public function topyear(){
        $query= Statistic::select(DB::raw('YEAR(created_at) as year,Sum(price) AS tongTien'))
        ->groupBy('year')
        ->orderBy('year')
        ->limit(1)->get();
        foreach($query as $val){
            echo "Total sales of year :".$val['year']." is :".$val['tongTien']."VND";
        }
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
