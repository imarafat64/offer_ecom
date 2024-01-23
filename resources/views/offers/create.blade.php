@extends('offers.layout.main')
@section('main-container')
    

<div class="col-8 grid-margin " style="margin: auto">
  <a href="{{ route('dashboard') }}"><button type="submit" class="btn btn-primary me-2">Back</button></a>
    <div class="card">
      <div class="card-body">
        <h4 class="card-title">Basic form elements</h4>
        <p class="card-description">
          Basic form elements
        </p>
        <form action="{{ route('offers.store') }}" method="post" enctype="multipart/form-data">
            @csrf

           
          <div class="form-group">
            <label for="exampleInputName1">Name</label>
            <input name="title"  value="{{ old('title') }}" type="text" class="form-control" id="exampleInputName1" placeholder="Name"  >
                
            
            @error('title')
               <div class="alert alert-danger">{{ $message }}</div>
           @enderror
          </div>
          <div class="form-group">
            <label for="exampleInputEmail3">Price</label>
            <input name="price" value="{{ old('price') }}" type="number" min="0" required="required" class="form-control" id="exampleInputEmail3" placeholder="Price">
          </div>
          
          <div class="form-group">
            <label for="exampleSelectGender">Category</label>
              <select class="form-control" id="exampleSelectGender" name="categories">
                <option>Select categories...</option>
                @foreach($categories as $category)
                                            <option {{ $category->id == old('categories') ? 'selected' : '' }} value="{{ $category->id }}"> {{ $category->title }}</option>
                                        @endforeach
              </select>
            </div>
            <div class="form-group">
                <label for="exampleSelectGender">Location</label>
                  <select class="form-control" id="exampleSelectGender" name="locations">
                    <option>Select Location...</option>
                    option>
                    @foreach($locations as $location)
                        <option {{ $location->id == old('locations') ? 'selected' : '' }} value="{{ $location->id }}"> {{ $location->title }}</option>
                    @endforeach
                  </select>
                </div>
          <div class="form-group">
            <label>File upload</label>
            {{-- <input type="file" name="img[]" class="file-upload-default"> --}}
            <div class="input-group col-xs-12">
             
              <input type="file" name="image" id="" class="form-control file-upload-info">              <span class="input-group-append">
                <button class="file-upload-browse btn btn-primary" type="button">Upload</button>
              </span>
            </div>
            
          </div>
         
          <div class="form-group">
            <label for="exampleTextarea1">Textarea</label>
            <textarea name="description" rows="5" class="form-control" id="exampleTextarea1" rows="4"></textarea>
          </div>
          <button type="submit" class="btn btn-primary me-2">Submit</button>
          <button class="btn btn-light">Cancel</button>
        </form>
      </div>
    </div>
  </div>
  @endsection