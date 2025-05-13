@extends('layouts.admin')

@section('page_title','Product List')
@section('product_select','nav-link active')
@section('productlist_select','active')
@section('active_product_nav','show')

@section('content')
<main id="main" class="main">
    <div class="pagetitle">
        <h1>Dashboard</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active">Product List</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->
    <div class="col-12">
        <div class="card recent-sales overflow-auto">
            @if(session()->has('message'))
                <div class="alert alert-secondary alert-dismissible fade show" role="alert">
                    {{session('message')}}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <div class="card-body">
                <h5 class="card-title">Product list</h5>

                <table class="table table-borderless" id="example">
                    <thead>
                        <tr>
                            <th scope="col">SN</th>
                            <th scope="col">Name</th>
                            <th scope="col">Email</th>
                            <th scope="col">Phone</th>
                            <th scope="col">Subject</th>
                            <th scope="col">Message</th>
                            <th scope="col">Time</th>
                            <!-- <th scope="col">Mail Reply</th> -->
                            <!-- <th scope="col">Action</th> -->
                        </tr>
                    </thead>
                    <tbody>
                        @php $sn=1; @endphp
                        @foreach($contantforms as $list)
                            <tr  ed="{{$list->subject}}" df="{{$list->email}}" id="{{$list->id}}">
                                <td>{{$sn++}}</td>
                                <td>{{$list->name}}</td>
                                <td>{{$list->email}}</td>
                                <td>{{$list->phone}}</td>
                                <td>{{$list->subject}}</td>
                                <td>{{$list->msg}}</td>
                                <td>{{ \Carbon\Carbon::parse($list->created_at)->format('M d Y g:i A')}}</td>
                                <!-- <td>@if($list->resend_mail ==1) <span class="check-right"><i class="bi bi-check fs-18"></i></span> @endif</td> -->
                                <!-- <td>
                                    <button class="btn btn-primary modal_btn_approved">Reply Mail</button>
                                    <a href="#">
                                        <button type="button" class="btn btn-secondary mt-1">History</button>
                                    </a>
                                </td>                         -->
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
  
</main>
@endsection

@push('scripts')
@endpush