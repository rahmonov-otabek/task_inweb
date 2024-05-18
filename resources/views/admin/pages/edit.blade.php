@extends('layouts.admin')

@section('title')
    Edit page
@endsection

@section('css')
<script src="https://cdn.ckeditor.com/ckeditor5/41.4.2/classic/ckeditor.js"></script>

<style type="text/css">
    .ck-editor__editable_inline
    {
      height: 300px;
    }
</style>   
@endsection 

@section('content')
    <div class="row">
        
        <div class="col-12 col-md-12 col-lg-12">
            <form action="{{ route('admin.pages.update', $page->id) }}" method="POST">
                @csrf
                @method('PUT') 
                <div class="card">
                  <div class="card-header">
                    <h4>Edit page</h4>
                  </div>
                  <div class="card-body">
                    <div class="form-group">
                      <label>Title</label>
                      <input type="text" name="title" value="{{ $page->title }}" class="form-control @error('title')  is-invalid @enderror">
                      @error('title') <div class="invalid-feedback"> {{ $message }} </div> @enderror
                    </div>
                    <div class="form-group">
                      <label for="short_description">Short description:</label>
                      <textarea id="short_description" name="short_description" class="form-control @error('short_description') is-invalid @enderror">{{  $page->short_description  }}</textarea>
                      @error('short_description') 
                          <div class="invalid-feedback">{{ $message }}</div> 
                      @enderror 
                    </div>
                    <div class="form-group">
                      <label for="full_description">Full description:</label>
                      <textarea id="full_description" name="full_description" class="form-control @error('full_description') is-invalid @enderror">{{  $page->full_description  }}</textarea>
                      @error('full_description') 
                          <div class="invalid-feedback">{{ $message }}</div> 
                      @enderror
                    </div>  
                  </div>
                  <div class="card-footer text-right">
                    <button class="btn btn-primary mr-1" type="submit">Update</button> 
                  </div>
                </div> 
            </form>
        </div>
        
    </div>
@endsection

@section('js')
<script>
  ClassicEditor
      .create(document.querySelector('#full_description'), {
          ckfinder: {
              uploadUrl: "{{ route('ckeditor.upload', ['_token' => csrf_token()]) }}",
          }
      })
      .catch(error => {
          console.error(error);
      });
</script>
@endsection