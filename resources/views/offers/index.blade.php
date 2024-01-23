
@extends('offers.layout.main')
@section('main-container')
    
<div class="col-lg-12 grid-margin stretch-card">
    <div class="card">
      <a href="{{ route('dashboard') }}"><button type="submit" class="btn btn-primary me-2">Back</button></a>
      <a href="{{ route('offers.create') }}"><button type="submit" class="btn btn-danger me-2">Create</button></a>
   
      <div class="card-body">
        <h4 class="card-title">Offer Table</h4>
        {{-- <p class="card-description">
         <a href="{{ route('offers.create') }}" style="color: rgb(7, 7, 7);
         text-decoration: none"> Add Offer</a> 
        </p> --}}
        <div class="table-responsive">
          <table class="table table-striped">
            <thead>
              <tr>
                <th>
                  User
                </th>
                <th>
                  Title
                </th>
                <th>
                  Price
                </th>
                <th>
                 Image
                </th>
                <th>
                  Categories
                </th>
                <th>
                  Locations
                </th>
                <th>
                   Actions
                  </th>
              </tr>
            </thead>
            <tbody>
                @foreach($offers as $offer)
              <tr>
                <td class="py-1">
                  {{ $offer->author->name }}
                </td>
                <td>
                    <a href="{{ route('offers.show', $offer) }}" style="color: rgb(7, 7, 7);
                    text-decoration: none"
                    class="flex break-words items-center pl-4">
                     <span class="font-heading font-medium">{{ $offer->title }}</span>
                 </a>
                </td>
                <td>
                 
                    {{ $offer->price }}
                  
                </td>
                <td>
                 
                  <img src="{{asset( $offer->image )}}" alt="">
                
              </td>
                <td>
                  {{ getTitles($offer->categories) }} 
                </td>
                <td>
                  {{ getTitles($offer->locations) }}
                </td>
                <td>
                 <a href="{{ route('offers.edit', $offer->id)}}" style="color: white;
                    text-decoration: none"> <button  class="btn btn-primary me-2" >Edit</button></a>
                              {{-- <button type="submit" class="btn btn-danger me-2"  style="color: white"><a href="{{ route('offers.destroy', $offer->id)}}" style="color: white;
                                text-decoration: none">Delete</a></button>

                      --}}

         <form class="me-2" action="{{route('offers.destroy', $offer->id)}}" method="post">
           @csrf
           @method('DELETE')
           <button type="submit" class="btn btn-danger me-2"  style="color: white">Delete</button>
         </form>
          
                  </td>
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
  @endsection