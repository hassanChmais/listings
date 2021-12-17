<?php

namespace App\Http\Controllers;

use App\Models\Listing;
use App\Models\Category;
use App\Models\Color;
use App\Http\Requests\StoreListingRequest;
use App\Http\Requests\UpdateListingRequest;
use Spatie\MediaLibrary\InteractsWithMedia;
use Redirect;

class ListingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $listings = Listing::with(['categories','colors'])
                   ->when(request('title'),function($query){
                    $query->where('title','LIKE','%'.request('title').'%');
                   })
                   ->when(request('category'),function($query){
                    $query->whereHas('categories',function($query2){
                       $query2->where('id',request('category'));
                    });
                   })
                   ->when(request('color'),function($query){
                    $query->whereHas('colors',function($query2){
                       $query2->where('id',request('color'));
                    });
                   })
                    ->when(request('saved'),function($query){
                    $query->whereHas('savedUsers',function($query2){
                       $query2->where('id',auth()->id());
                    });
                })
                   ->paginate(5)->withQueryString();


        $categories = Category::all();
        $colors = Color::all();

        return view('listings.index',compact('listings','categories','colors'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        $colors = Color::all();

        return view('listings.create',compact('categories','colors'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreListingRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreListingRequest $request)
    {
        $listing = auth()->user()->listings()->create($request->validated());
        $listing->addMultipleMediaFromRequest(['photos'])
                ->each(function ($fileAdder) {
                        $fileAdder->toMediaCollection('listings');
                                             }); 
        $listing->categories()->attach($request->categories);
        $listing->colors()->attach($request->colors);

        
        
        return Redirect::back()->with('success','Listing Inserted Successfully !');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Listing  $listing
     * @return \Illuminate\Http\Response
     */
    public function show(Listing $listing)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Listing  $listing
     * @return \Illuminate\Http\Response
     */
    public function edit(Listing $listing)
    {
        $this->authorize('update',$listing);
        $medias = $listing->getMedia('listings');
        $categories = Category::all();
        $colors = Color::all();
        return view('listings.edit',compact('listing','medias','categories','colors'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateListingRequest  $request
     * @param  \App\Models\Listing  $listing
     * @return \Illuminate\Http\Response
     */
    public function update(StoreListingRequest $request, Listing $listing)
    {
        $this->authorize('update',$listing);
        $listing->update($request->validated());
        if($request->photos){
        $listing->addMultipleMediaFromRequest(['photos'])
                ->each(function ($fileAdder) {
                        $fileAdder->toMediaCollection('listings');
                                             });
        }
        $listing->categories()->sync($request->categories);
        $listing->colors()->sync($request->colors);
        return Redirect::back()->with('success','This Listing Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Listing  $listing
     * @return \Illuminate\Http\Response
     */
    public function destroy(Listing $listing)
    {
        $this->authorize('delete',$listing);
        $listing->delete();
        return Redirect::back()->with('success','Listing Deleted Successfully');
    }

    public function delete_photo($listingId,$id){
$listing = Listing::where('user_id',auth()->id())->findOrFail($listingId);
$photo = $listing->getMedia('listings')->where('id',$id)->first();
    $photo->delete();

return Redirect::back()->with('success','Photo Deleted Successfully');
    }
}
