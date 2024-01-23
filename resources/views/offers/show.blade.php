@extends('offers.layout.main')
@section('main-container')

<div class="container mx-auto">
    <section class="py-8">
        <div class="bg-gray-100 py-2 md:py-6 sm:py-12 flex flex-col md:flex-row gap-4 md:justify-center align-items">
            <div class="relative md:w-full max-w-3xl px-5 py-4 md:py-10 bg-white mx-6 shadow rounded-3xl h-full">
                <h2 class="font-semibold text-xl text-gray-700 leading-relaxed text-center border-b border-b-gray-500 pb-2">Offer details</h2>
                <div class="p-4 md:p-8 text-base leading-6 space-y-4 text-gray-700 sm:text-lg sm:leading-7">
                    <div class="flex items-center justify-center p-4">
                        <img class="w-48 h-32 md:w-96 md:h-72 object-cover rounded-3xl" src="{{ asset($offer->image) }}" alt="">
                    </div>
                    <div class="flex flex-col">
                        <label class="leading-loose text-sm font-bold">Title :  </label>   <span> {{ $offer->title }}</span><br/><br/>
                        {{-- <p>
                           
                        </p> --}}
                    </div>
                    <div class="flex flex-col">
                        <label class="leading-loose text-sm font-bold">Price :</label>  <span> {{ $offer->price }}</span><br/><br/>
                        {{-- <div>
                            {{ $offer->price }}
                        </div> --}}
                    </div>
                    <div class="flex flex-col">
                        <label class="leading-loose text-sm font-bold">Created by :</label>   <span>{{ $offer->author->name }}</span><br/><br/>
                        {{-- <div>
                            <br/><br/>
                        </div> --}}
                    </div>
                    <div class="flex flex-col">
                        <label class="leading-loose text-sm font-bold">Category : </label>  <span>  {{ getTitles($offer->categories) }}</span><br/><br/>
                       
                    </div>
                    <div class="flex flex-col">
                        <label class="leading-loose text-sm font-bold">Location : </label>  <span> {{ getTitles($offer->locations) }}</span><br/><br/>
                        <div>
                        <div>
                            {{-- {{ getTitles($offer->locations) }} --}}
                        </div>
                    </div>
                    <div class="flex flex-col">
                        <label class="leading-loose text-sm font-bold">Description :</label>  <span> {{ $offer->description }}</span><br/><br/>
                        {{-- <div>
                            {{ ($offer->) }}
                        </div> --}}
                    </div>

                </div>
            </div>
        </div>
    </section>
</div>
@endsection