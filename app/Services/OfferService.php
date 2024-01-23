<?php

namespace App\Services;

use App\Filters\OfferFilter;
use App\Models\Offer;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\URL;

class OfferService
{
    public function store(array $data)
    {
        DB::transaction(function () use ($data) {
            // dd(auth()->user()->id);
            $data = array_merge([
                'author_id' => auth()->user()->id,
            ], $data);
            // dd($data);
            // $offer = Offer::create($data);
            $offer = new Offer();
            $offer->title = $data['title'];
            $offer->price = $data['price'];
            $offer->description = $data['description'];
            $offer->author_id = $data['author_id'];
            $image = $data['image'];

            $imageName = time() . '.' . $image->extension();
            $imagePath = 'images/' . $imageName;
            $imageUrl = URL::to($imagePath);
            $success = $image->move(public_path('images'), $imageName);
            $offer->image = $imageUrl;

            $offer->save();

            $offer->categories()->sync($data['categories']);
            $offer->locations()->sync($data['locations']);

            // if ($image) {
            //     $offer->addMedia($image)
            //         ->toMediaCollection();
            // }
        }, 5);
    }

    public function update(Offer $offer, array $data)
    {
        DB::transaction(function () use ($offer, $data) {
            $data = array_merge([
                'author_id' => auth()->user()->id,
            ], $data);
            // dd($data);

            $offer = tap($offer)->update($data);


            $offer->categories()->sync($data['categories']);
            $offer->locations()->sync($data['locations']);

            $image = $data['image'];

            $imageName = time() . '.' . $image->extension();
            $imagePath = 'images/' . $imageName;
            $imageUrl = URL::to($imagePath);
            $success = $image->move(public_path('images'), $imageName);
            $offer->image = $imageUrl;

            $offer->update();
        }, 5);
    }

    public function get(array $queryParams = [])
    {
        $queryBuilder = Offer::with(['author', 'categories', 'locations'])->latest();

        $offers = resolve(OfferFilter::class)->getResults([
            'builder' => $queryBuilder,
            'params' => $queryParams
        ]);

        return $offers;
    }

    public function getMine(array $queryParams = [])
    {
        $queryBuilder = Offer::with(['author', 'categories', 'locations'])
            ->where('author_id', auth()->user()->id)
            ->latest();

        $offers = resolve(OfferFilter::class)->getResults([
            'builder' => $queryBuilder,
            'params' => $queryParams
        ]);

        return $offers;
    }

    public function destroy(Offer $offer)
    {
        $offer->update([
            'deleted_by' => auth()->user()->id,
            'deleted_at' => now()
        ]);
    }
}
