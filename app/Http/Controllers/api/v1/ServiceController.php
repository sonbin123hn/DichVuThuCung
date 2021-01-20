<?php

namespace App\Http\Controllers\api\v1;

use App\Helpers\Helper;
use App\Http\Controllers\Controller;
use App\Models\Receipt;
use App\Models\Service;
use App\Models\Statistic;
use Illuminate\Http\Request;

class ServiceController extends ApiController
{
    public function store(Request $request)
    {
        $data = $request->all();
        $data['user_id'] = $request->user_id;
        if(isset($request->date)){
            $data['date'] = Helper::formatSqlDate(strtotime($request->date));
        }
        if(isset($request->time)){
            $data['time'] = Helper::formatTime(strtotime($request->time));
        }
        if(isset($request->date_go)){
            $data['date_go'] = Helper::formatSqlDate(strtotime($request->date_go));
        }
        if(isset($request->time_go)){
            $data['time_go'] = Helper::formatTime(strtotime($request->time_go));
        }
        $data['service_id'] = $request->service_id;
        //price
        $arr = Service::Where('id',$data['service_id'])->get();
        foreach($arr as $val){
            $price = $val['price'];
        }

        if(Receipt::create($data)){
            $new = Statistic::create([
                'user_id' => $data['user_id'],
                'service_id' => $data['service_id'],
                'price'=> $price,
            ]);
            return $this->sendMessage("Đặt dịch vụ thành công");
        }
        return $this->sendError400('Bad Request', 'Đặt lịch thất bại.');
    }
}
