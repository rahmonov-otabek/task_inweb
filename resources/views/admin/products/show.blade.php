@extends('layouts.admin')

@section('title')
    Product
@endsection

@section('content')
    <div class="row">
        
        <div class="col-12 col-md-12 col-lg-12"> 
            <div class="card">
              <div class="card-header">
                <h4>Products ID {{ $product->id }}</h4>
                <a href="{{ route('admin.products.index') }}" class="btn btn-primary">Back</a>
              </div>
              <div class="card-body"> 
                    <div class="table-responsive">
                        <table class="table">
                            <tr>
                                <th>ID</th><td>{{ $product->id }} </td>
                            </tr>
                            <tr>
                                <th>Title</th><td>{{ $product->title }} </td>
                            </tr>
                            <tr>
                                <th>Image</th><td><img src="{{ asset('storage/public/product/'.$product->image)}}" width="250px" alt=""></td>
                            </tr>
                            <tr>
                                <th>Category</th><td>{{ $product->category->title }} </td>
                            </tr>
                            <tr>
                                <th>Short description</th><td>{{ $product->short_description }} </td>
                            </tr>
                            <tr>
                                <th>Full description</th><td>{!! $product->full_description !!} </td>
                            </tr>
                            <tr>
                                <th>Created at</th><td>{{ $product->created_at }} </td>
                            </tr>
                        </table>
                    </div>
              </div> 
            </div>  
        </div>
        
    </div>
@endsection