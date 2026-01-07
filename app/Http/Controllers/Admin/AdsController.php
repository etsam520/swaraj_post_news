<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Ads;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;
use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\ImageManager;

class AdsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()  : View
    {
       $ads = Ads::orderBy('status', 'asc')->orderBy('created_at', 'desc')->get();
        return view('admin.ads._table',compact('ads'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()  : View
    {
        return view('admin.ads._add');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request) : \Illuminate\Http\RedirectResponse
    {
        $validatedData = $request->validate([
            'title'       => 'required|string|max:255',
            'link'        => 'nullable|url|max:2048', // max 2048 characters for URLs
            'description' => 'nullable|string',
            'cover_image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048', // 2MB max
            'status'      => 'required|boolean',
            // 'city'        => 'nullable|exists:cities,id', // Uncomment if city field is used
        ]);


        $imagePath = null;
        if ($request->hasFile('cover_image')) {

            $imageManager = new ImageManager( new Driver());
            $image = $imageManager->read($request->file('cover_image')->getPathname())
            ->scale(width: 1200)
            ->toJpeg(quality: 75);


           $imagePath = env('UPLOADS_DIR').'ads/' . uniqid() . '.jpg';
            Storage::disk('s3')->put($imagePath, $image->toString(), 'public');
        }

        // 3. Create a new Ad instance and save to the database
        $ad = Ads::create([
            'title'       => $validatedData['title'],
            'link'        => $validatedData['link'],
            'description' => $validatedData['description'],
            'cover_image' => $imagePath, // Store the path
            'status'      => $validatedData['status'],
            // 'city_id' => $validatedData['city'] ?? null, // If using city, handle null
        ]);

        return redirect()->route('admin.ads.index')->with('success', 'Ad created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id) : View
    {
      $ad =  Ads::find($id);
        return view('admin.ads._edit', compact('ad'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id): \Illuminate\Http\RedirectResponse
    {

        $validatedData = $request->validate([
            'title'       => 'required|string|max:255',
            'link'        => 'nullable|url|max:2048',
            'description' => 'nullable|string',
            // Image is not required on update, but validated if present
            'cover_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'status'      => 'required|boolean',
        ]);

         $ad = Ads::find($id);

        // Handle image upload if a new one is provided
        if ($request->hasFile('cover_image')) {
            // Delete old image if it exists
            if ($ad->cover_image) {
                Storage::disk('s3')->delete($ad->cover_image);
            }

            $imageManager = new ImageManager( new Driver());
            $image = $imageManager->read($request->file('cover_image')->getPathname())
            ->scale(width: 1200)
            ->toJpeg(quality: 75);

            $imagePath = env('UPLOADS_DIR').'ads/' . uniqid() . '.jpg';
            Storage::disk('s3')->put($imagePath, $image->toString(), 'public');
            $validatedData['cover_image'] = $imagePath ;
        } else {
            $validatedData['cover_image'] = $ad->cover_image;
        }

        // Update the Ad instance
        $ad->update($validatedData);

        return redirect()->route('admin.ads.index')->with('success', 'Ad updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id): \Illuminate\Http\RedirectResponse
    {
        $ad = Ads::find($id);
        // Delete the image file from storage first
        if ($ad->cover_image) {
            Storage::disk('s3')->delete($ad->cover_image);
        }

        // Delete the ad record from the database
        $ad->delete();

        return redirect()->route('admin.ads.index')->with('success', 'Ad deleted successfully!');
    }
}
