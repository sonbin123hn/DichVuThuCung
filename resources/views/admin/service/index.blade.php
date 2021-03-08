@extends('admin.layouts.master')

@section('page-breadcrum')
<div class="page-breadcrumb">
                <div class="row">
                    <div class="col-5 align-self-center">
                        <h4 class="page-title">service</h4>
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
                            @if(session('success'))
                                <div class="alert alert-success alert-dismissible">
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                    <h4><i class="icon fa fa-check"></i> Thông báo!</h4>
                                    {{session('success')}}
                                </div>
                            @endif
                            
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">Stt</th>
                                    <th scope="col">Name Service</th>
                                    <th scope="col">Detail</th>
                                    <th scope="col">Price</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($service as $value)
                                    <tr>
                                        <th scope="row">{{ $value['id'] }}</th>
                                        <td>{{$value['service_name']}}</td>
                                        <td>{{$value['detail']}}</td>
                                        <td>{{$value['price']}}</td>
                                        <td>
                                        <a href="{{ route('admin.service.remove', ['id' => $value['id']]) }}" onclick="return confirm('Do you want to delete this service ?')">
                                        <i style="font-size:24px;margin-right:5px;" class="fa fa-trash"></i>
                                        </a>
                                            <a href="{{ route('admin.service.edit', ['id' => $value['id']]) }}"><i style="font-size:24px" class="fa">&#xf044;</i></a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        You are on page {{$service->currentPage()}}
                        <a style="font-size: 20px;margin-right: 20px;" href="{{$service->previousPageUrl()}}" id="previousPagebtn"><</a>
                        <a style="font-size: 20px;" href="{{$service->nextPageUrl()}}" id="nextPagebtn">></a>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-12">
                            <button class="btn btn-success"><a style="color: white;" href="{{ url('/admin/service/add')}}">Add service</a></button>
                        </div>
                    </div>
            </div>
@endsection
@section('footer')
<footer class="footer text-center">
                All Rights Reserved by Nice admin. Designed and Developed by
                <a href="https://www.facebook.com/sonbin1999/">Mai La AE Team</a>.
            </footer>
@endsection