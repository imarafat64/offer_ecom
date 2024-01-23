@extends('offers.layout.main')
@section('main-container')
    

<div class="col-8 grid-margin " style="margin: auto">
    <div class="card">
      <div class="card-body">
        <h4 class="card-title">Basic form elements</h4>
        <p class="card-description">
          Basic form elements
        </p>
        <form action="{{ route('offers.update', $offer->id) }}" method="post" class="" enctype="multipart/form-data">
            @csrf
            @method('PUT')

          <div class="form-group">
            <label for="exampleInputName1">Name</label>
            <input name="title" value="{{ old('title', $offer->title) }}" type="text" required="required" class="form-control" id="exampleInputName1" placeholder="Name">
          </div>
          <div class="form-group">
            <label for="exampleInputEmail3">Price</label>
            <input name="price" value="{{ old('price', $offer->price) }}" type="number" min="0" required="required" class="form-control" id="exampleInputEmail3" placeholder="Price">
          </div>
          
          <div class="form-group">
            <label for="exampleSelectGender">Category</label>
              <select class="form-control" id="exampleSelectGender" name="categories">
                <option>Select categories...</option>
                @foreach($categories as $category)
                <option {{ in_array($category->id, old('categories', $offer->categories->pluck('id')->toArray())) ? 'selected' : '' }} value="{{ $category->id }}"> {{ $category->title }}</option>
            @endforeach
              </select>
            </div>
            <div class="form-group">
                <label for="exampleSelectGender">Location</label>
                  <select class="form-control" id="exampleSelectGender" name="locations">
                    <option>Select Location...</option>
                    option>
                    @foreach($locations as $location)
                                            <option {{ in_array($location->id, old('locations', $offer->locations->pluck('id')->toArray())) ? 'selected' : '' }} value="{{ $location->id }}"> {{ $location->title }}</option>
                                        @endforeach
                  </select>
                </div>
          <div class="form-group">
            <label>File upload</label>
            <div class="flex items-center justify-center p-4">
              <img class="w-96 h-72 object-cover rounded-3xl" src="{{ asset($offer->image) }}" alt="">
          </div>
            <input type="file" name="img[]" class="file-upload-default">
            <div class="input-group col-xs-12">
             
            <input type="file" name="image" id="" class="form-control file-upload-info">              <span class="input-group-append">
              <span class="input-group-append">
                <button class="file-upload-browse btn btn-primary" type="button">Upload</button>
              </span>
            </div>
          </div>
         
          <div class="form-group">
            <label for="exampleTextarea1">Textarea</label>
            <textarea name="description" rows="5" class="form-control" id="exampleTextarea1" rows="4">{{ old('description', $offer->description) }}</textarea>
          </div>
          <button type="submit" class="btn btn-primary me-2">Submit</button>
          <button class="btn btn-light">Cancel</button>
        </form>
      </div>
    </div>
  </div>
  @endsection