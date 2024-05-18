@extends('layouts.admin')

@section('title')
    Category
@endsection

@section('content')
    <div class="row">
        
        <div class="col-12 col-md-12 col-lg-12"> 
            <div class="card">
              <div class="card-header">
                <h4>category ID {{ $category->id }}</h4>
                <a href="{{ route('admin.categories.index') }}" class="btn btn-primary">Back</a>
              </div>
              <div class="card-body"> 
                    <div class="table-responsive">
                        <table class="table">
                            <tr>
                                <th>ID</th><td>{{ $category->id }} </td>
                            </tr>
                            <tr>
                                <th>Title</th><td>{{ $category->title }} </td>
                            </tr>
                            <tr>
                                <th>Image</th><td><img src="{{ asset('storage/category/'.$category->image)}}" width="250px" alt=""></td>
                            </tr>
                            <tr>
                                <th>Short description</th><td>{{ $category->short_description }} </td>
                            </tr>
                            <tr>
                                <th>Full description</th><td>{!! $category->full_description !!} </td>
                            </tr>
                            <tr>
                                <th>Created at</th><td>{{ $category->created_at }} </td>
                            </tr>
                        </table>
                    </div>
              </div> 
            </div>  
        </div>
        
    </div>
@endsection