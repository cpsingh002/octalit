
@extends('layouts.admin')
@section('page_title','Product Edit')
@section('product_select','nav-link active')
@section('productadd_select','active')
@section('active_product_nav','show')

@section('content')
<main id="main" class="main">
        <div class="pagetitle">
            <h1>Dashboard</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">Product Edit</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->
        <div class="col-12">
    <div class="card recent-sales overflow-auto">

      <div class="card-body">
        <h5 class="card-title">Basic Product information</h5>

        <div class="row">
                 <div class="col-md-10 m-auto">
                     <div class="sa-entity-layout">
                         <div class="sa-entity-layout__body">
                             <div class="sa-entity-layout__main">
                                 <div class="card">
                                     <div class="card-body p-5">
                                     @if(Session::has('message'))
                                         <div class="alert alert-success" role="alert">{{Session::get('message')}}</div>
                                         @endif

                                         <form class="form-horizontal" action="{{route('products.update', $product->id)}}" method= "post" enctype="multipart/form-data">
                                            @method('PATCH')   
                                            @csrf 
                                            <div class="mb-5">
                                                 <h2 class="mb-0 fs-exact-18">Basic information</h2>
                                             </div>
                                             <div class="mb-4">
                                                 <label for="form-category/name" class="form-label">Name</label>
                                                 <input type="text" placeholder="Name" class="form-control"  name="name" id ="name" value="{{$product->name}}"  required/>
                                                     @error('name') <p class="text-danger">{{$message}}</p> @enderror
                                             </div>
                                             <div class="mb-4">
                                                 <label for="form-category/name" class="form-label">Slug</label>
                                                 <input type="text" placeholder="Slug" class="form-control"  name="slug" id="slug" value="{{$product->slug}}" required/>
                                                     @error('slug') <p class="text-danger">{{$message}}</p> @enderror
                                             </div>
                                             <div class="mb-4">
                                                 <label for="form-category/slug" class="form-label">Regular Price</label>
                                                 <div class="input-group input-group--sa-slug">
                                                    <input type="test" placeholder="Enter Regular Price Here" class="form-control input-md" name="regular_price" value="{{$product->regular_price}}" required/>
                                                    @error('regular_price') <p class="text-danger">{{$message}}</p> @enderror
                                                 </div>
                                             </div>
                                             <div class="mb-4">
                                                    <label for="form-category/parent-category" class="form-label">Sale Price</label>
                                                    <input type="text" placeholder="Enter Sale Price Here" class="form-control input-md"  name="sale_price" value="{{$product->sale_price}}" required/>
                                                    @error('sale_price') <p class="text-danger">{{$message}}</p> @enderror
                                             </div>
                                             <div class="mb-4">
                                                    <label for="form-category/parent-category" class="form-label">Quantity</label>
                                                    <input type="text" placeholder="Enter Quantity here" class="form-control input-md"  name="quantity" value="{{$product->quantity}}" required/>
                                                    @error('quantity') <p class="text-danger">{{$message}}</p> @enderror
                                             </div>
                                             <div class="form-group mb-4">
                                                <label class="col-md-4 control-label form-label">Image</label>
                                                <div class="col-md-4">
                                                    <input type="file" placeholder="Product Image Icon" class="form-control input-md"  name="image" />
                                                     @if($product->image)
                                                        <img src="{{asset('admin/images')}}/{{$product->image}}" width="120">
                                                    @endif                                                  
                                                    @error('image') <p class="text-danger">{{$message}}</p> @enderror
                                                </div>
                                            </div>
                                            
                                            <div class="mb-4">
                                                    <label for="form-category/parent-category" class="form-label">Short Description</label>
                                                     <textarea name="short_description" id="editor" class="form-control" value="{{$product->short_description}}" required>{{$product->short_description}}</textarea>
                                                    @error('short_description') <p class="text-danger">{{$message}}</p> @enderror
                                            </div>
                                            <div class="mb-4">
                                                    <label for="form-category/parent-category" class="form-label">Description</label>
                                                     <textarea name="description" id="editor" class="form-control" value="{{$product->description}}" required>{{$product->description}}</textarea>
                                                    @error('description') <p class="text-danger">{{$message}}</p> @enderror
                                            </div>


                                            
                                        
                                        
                                        

                                             <div class="mb-4 text-center">
                                                 <button type="submit" class="btn btn-primary">Update</button>
                                             </div>

                                         </form>

                                     </div>
                                 </div>



                             </div>

                         </div>
                     </div>
                 </div>
             </div>

      </div>

    </div>
  </div>
  
</main>
@endsection


@push('scripts')
 <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
 <script>
        $(document).ready(function() {
            // Function to generate the slug
            $('#name').on('input', function() {
                var name = $(this).val(); // Get the value of the input
                var slug = name
                    .toLowerCase()  // Convert to lowercase
                    .trim()         // Remove leading/trailing spaces
                    .replace(/[^a-z0-9\s-]/g, '')  // Remove non-alphanumeric characters
                    .replace(/\s+/g, '-') // Replace spaces with hyphens
                    .replace(/-+/g, '-');  // Remove multiple hyphens
                
                // Set the generated slug in the slug field
                $('#slug').val(slug);
            });
        });
    </script>
@endpush