@extends('admin.layouts.master')

@section('page-breadcrum')
<div class="page-breadcrumb">
    <div class="row">
        <div class="col-5 align-self-center">
            <h4 class="page-title">Receipts</h4>
        </div>
        <div class="col-7 align-self-center">
            <div class="d-flex align-items-center justify-content-end">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="#">Home</a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Basic Table</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</div>
@endsection
@section('container-fluid')
<div class="container-fluid">
    <div class="table-responsive">
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">Stt</th>
                    <th scope="col">Name Member</th>
                    <th scope="col">Name Service</th>
                    <th scope="col">Price</th>
                </tr>
            </thead>
            <tbody>
                @foreach($static as $value)
                <tr>
                    <th scope="row">{{ $value['id'] }}</th>
                    @foreach($user as $val_user)
                    @if($value['user_id'] == $val_user['id'])
                    <td>{{ $val_user['name'] }}</td>
                    @endif
                    @endforeach

                    @foreach($service as $val_service)
                    @if($value['service_id'] == $val_service['id'])
                    <td>{{ $val_service['service_name'] }}</td>
                    @endif
                    @endforeach
                    <td>{{$value['price']}}</td>

                </tr>
                @endforeach
            </tbody>
        </table>
        You are on page {{$static->currentPage()}}
        <a style="font-size: 20px;margin-right: 20px;" href="{{$static->previousPageUrl()}}" id="previousPagebtn"><</a>
        <a style="font-size: 20px;" href="{{$static->nextPageUrl()}}" id="nextPagebtn">></a>
    </div>

    <div style="margin-top:100px;margin-right: 120px; " class="container-fluid col-8">
        <form name='formTextbox' onSubmit="return getValue(event)">
            <div class="form-group">
                <label>Statistic:</label>
                <div class="col-9 d-flex justify-content-between">
                    <input type="number" name="day" id="day" class="form-control ml-1" placeholder="Enter day">
                    <input type="number" name="month" id="month" class="form-control ml-1" placeholder="Enter month">
                    <input type="number" name="year" id="year" class="form-control ml-1" placeholder="Enter year">
                    <button type="submit" class="btn btn-info ml-1">Submit</button>
                </div>
                <small id="emailHelp" class="form-text text-muted">If you not enter the day, it will be selected by
                    month of the year, otherwise will be by year
                </small>

            </div>
        </form>
        <form name="formRadio">
            <label for="exampleInputPassword1">Statistic select by:</label>
            <div class="col-10 float-right">
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="radioButton" id="inlineRadio" value="1">
                    <label class="form-check-label" for="inlineRadio1">Everyday</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="radioButton" id="inlineRadio" value="2">
                    <label class="form-check-label" for="inlineRadio2">Top month</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="radioButton" id="inlineRadio" value="3">
                    <label class="form-check-label" for="inlineRadio3">Top day</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="radioButton" id="inlineRadio" value="4">
                    <label class="form-check-label" for="inlineRadio4">Top year</label>
                </div>
            </div>
        </form>
        <h2 id="ketqua" style="display: none;"></h2>

    </div>
</div>
@endsection
@section('footer')
<footer class="footer text-center">
    All Rights Reserved by Nice admin. Designed and Developed by
    <a href="https://www.facebook.com/sonbin1999/">Mai La AE Team</a>.
</footer>
@endsection
@section('script')
<style>
    input::-webkit-outer-spin-button,
    input::-webkit-inner-spin-button {
        -webkit-appearance: none;
        margin: 0;
    }

    /* Firefox */
    input[type=number] {
        -moz-appearance: textfield;
    }
</style>
<script>
$(document).ready(function() {
    $('form').submit(function(){
        // var day = $('#day').val();
        // var month = $('#month').val();
        // var year = $('#year').val();
        let flag = true
        let day = document.forms['formTextbox'].day.value
        let month = document.forms['formTextbox'].month.value
        let year = document.forms['formTextbox'].year.value
        if (day.toString().length < 0 || day > 31 || day.toString().length > 2)
            flag = false
        if (month.toString().length < 0 || month > 13 || month.toString().length > 2)
            flag = false
        if (year.toString().length <= 0 || year > new Date().getFullYear().toString() || year.toString().length > 4)
            flag = false
        if(flag){
            $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
            });
            $.ajax({
                method: "POST",
                url: '/admin/ajax_date',
                data:{
                    "_token": "{{ csrf_token() }}",
                    day: day,
                    month: month,
                    year: year
                },
                success: function(data) {
                    $('#ketqua').text("Total sales in :"+day+"-"+month+"-"+year+" : is : "+data).show();
                }
            })
        }else{
            alert("");
        }
    })
    $('.form-check-input').click(function(){
        $check = $(this).val();
        if($check == 1){
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                method: "GET",
                url: '/admin/ajax_everyday',
                success: function(data) {
                    $('#ketqua').text("Total sales of Boo's Home is : "+data).show();
                }
            })
        }
        if($check == 2){
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                method: "GET",
                url: '/admin/ajax_month',
                success: function(data) {
                    $('#ketqua').text(data).show();
                }
            })
        }
        if($check == 3){
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                method: "GET",
                url: '/admin/ajax_day',
                success: function(data) {
                    $('#ketqua').text(data).show();
                }
            })
        }
        if($check == 4){
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                method: "GET",
                url: '/admin/ajax_year',
                success: function(data) {
                    $('#ketqua').text(data).show();
                }
            })
        }
    })
    
})//document
</script>
@endsection