@extends('layouts.admin')

@section('title')
    Create product
@endsection

@section('css')
    <!-- include libraries(jQuery, bootstrap) -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
@endsection 

@section('content')
    <div class="row">
        
        <div class="col-12 col-md-12 col-lg-12">
            <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data">
            @csrf 
            <div class="card">
              <div class="card-header">
                <h4>Create product</h4>
              </div>
              <div class="card-body">
                <div class="form-group">
                  <label>Title</label>
                  <input type="text" name="title" class="form-control @error('title')  is-invalid @enderror">
                  @error('title') <div class="invalid-feedback"> {{ $message }} </div> @enderror
                </div>
                <div class="form-group">
                  <label>Category</label>
                  <select name="category_id" id="" class="form-control @error('category_id')  is-invalid @enderror" style="padding: 0px">
                      <option value="">Select Category</option>
                      @foreach ($categories as $category)
                          <option value="{{ $category->id }}">{{ $category->title }}</option>
                      @endforeach
                  </select>
                  @error('category_id') <div class="invalid-feedback"> {{ $message }} </div> @enderror
              </div>
                <div class="form-group">
                  <label>Image</label>
                  <input type="file" name="image" class="form-control @error('image')  is-invalid @enderror">
                  @error('image') <div class="invalid-feedback"> {{ $message }} </div> @enderror
                  </div> 
                <div class="form-group">
                  <label for="short_description">Short description:</label>
                  <textarea id="short_description" name="short_description" class="form-control @error('short_description') is-invalid @enderror"></textarea>
                  @error('short_description') 
                      <div class="invalid-feedback">{{ $message }}</div> 
                  @enderror 
                </div>
                <div class="form-group">
                  <label for="full_description">Full description:</label>
                  <textarea id="full_description" name="full_description" class="form-control @error('full_description') is-invalid @enderror"></textarea>
                  @error('full_description') 
                      <div class="invalid-feedback">{{ $message }}</div> 
                  @enderror
                </div>   
              </div>
              <div class="card-footer text-right">
                <button class="btn btn-primary mr-1" type="submit">Create</button> 
              </div>
            </div> 
            </form>
        </div>
        
    </div>
    

@endsection

@section('js')
  <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>
  <script>
    $('#full_description').summernote({
      placeholder: 'description...',
      tabsize: 2,
      height: 300
    })
  </script>
@endsection

 