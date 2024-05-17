@extends('layouts.admin')

@section('title')
    Page
@endsection

@section('content')
    <div class="row">
        
        <div class="col-12 col-md-12 col-lg-12"> 
            <div class="card">
              <div class="card-header">
                <h4>Page ID {{ $page->id }}</h4>
                <a href="{{ route('admin.pages.index') }}" class="btn btn-primary">Back</a>
              </div>
              <div class="card-body"> 
                    <div class="table-responsive">
                        <table class="table">
                            <tr>
                                <th>ID</th><td>{{ $page->id }} </td>
                            </tr>
                            <tr>
                                <th>Title</th><td>{{ $page->title }} </td>
                            </tr>
                            <tr>
                                <th>Short description</th><td>{{ $page->short_description }} </td>
                            </tr>
                            <tr>
                                <th>Full description</th><td>{!! $page->full_description !!} </td>
                            </tr>
                            <tr>
                                <th>Created at</th><td>{{ $page->created_at }} </td>
                            </tr>
                        </table>
                    </div>
              </div> 
            </div>  
        </div>
        
    </div>
@endsection