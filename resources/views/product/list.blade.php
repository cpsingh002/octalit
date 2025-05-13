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
                            <th scope="col">Slug</th>
                            <th scope="col">Regular Price</th>
                            <th scope="col">Sale Price</th>
                            <th scope="col">Quantity</th>
                            <th scope="col">Image</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php $sn=1; @endphp
                        @foreach($products as $list)
                            <tr>
                                <td>{{$sn++}}</td>
                                <td>{{$list->name}}</td>
                                <td>{{$list->slug}}</td>
                                <td>{{$list->regular_price}}</td>
                                <td>{{$list->sale_price}}</td>
                                <td>{{$list->quantity}}</td>
                                <td>@if($list->image !='')
                                    <img width="100px" src="{{asset('admin/images/'.$list->image)}}"/>
                                    @else
                                        <p>null</p>
                                    @endif
                                </td>
                                <td>
                                    <a href="{{route('products.edit',$list->id)}}"><button type="button" class="btn btn-danger mt-1">Edit</button></a>
                                    <form action="{{ route('products.destroy', $list->id) }}" method="POST">
                                        @method('DELETE')
                                        @csrf
                                        <input type="submit" class="btn btn-dark mt-1" value="Delete" onclick="return confirm('Are you sure want to delete this product?.');" />
                                    </form>
                                </td>                        
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