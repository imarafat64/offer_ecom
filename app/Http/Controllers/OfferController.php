<?php

namespace App\Http\Controllers;

use App\Constants\Role;
use App\Models\Offer;
// use App\Models\User;
use App\Models\Category;
use App\Models\Location;
use Illuminate\Http\Request;
use App\Services\OfferService;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StoreOfferRequest;

class OfferController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, OfferService $offerService)
    {
        $this->authorize('viewAny', Offer::class);

        $categories = Category::orderBy('title')->get();
        $locations = Location::orderBy('title')->get();

        $offers = $offerService->get($request->query());

        return view('offers.index', compact('offers', 'categories', 'locations'));
    }


    public function myOffers(Request $request, OfferService $offerService)
    {
        $this->authorize('viewMy', Offer::class);

        $categories = Category::orderBy('title')->get();
        $locations = Location::orderBy('title')->get();

        $offers = $offerService->getMine($request->query());

        return view('offers.index', compact('offers', 'categories', 'locations'));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize('create', Offer::class);

        $categories = Category::orderBy('title')->get();
        $locations = Location::orderBy('title')->get();

        return view('offers.create', compact('categories', 'locations'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreOfferRequest $request,  OfferService $offerService)
    {

        // dd($request->all());
        //dd($request->validated());
        $this->authorize('create', Offer::class);


        $offerService->store(
            $request->validated()
        );

        return redirect('offers/my');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Offer $offer)
    {
        $offer->load(['author', 'categories', 'locations']);

        return view('offers.show', compact('offer'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Offer $offer)
    {
        $this->authorize('update', $offer);

        $categories = Category::orderBy('title')->get();
        $locations = Location::orderBy('title')->get();

        return view('offers.edit', compact('offer', 'categories', 'locations'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreOfferRequest $request, Offer $offer, OfferService $offerService)
    {
        $this->authorize('update', $offer);

        $offerService->update(
            $offer,
            $request->validated()

        );


        if (auth()->user()->role == 'admin') {
            return redirect()->intended('offers/');
        } elseif (auth()->user()->role == 'user') {
            return redirect()->intended('offers/my');;
        } else {
            return redirect()->back();
        }

        // if (auth()->user()->isAdmin()) {
        //     return redirect()->route('offers/'); // Redirect admin to the admin dashboard
        // } else {
        //     return redirect()->route('offers/my'); // Redirect regular user to the user dashboard
        // }
        // return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Offer $offer)
    {
        $offer->delete();

        return redirect()->back();
    }
}
