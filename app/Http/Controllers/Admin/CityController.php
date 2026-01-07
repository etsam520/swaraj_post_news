<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\City;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str ;

class CityController extends Controller
{
    public function index($state_id)
    {
        $cities = City::where('state_id', $state_id)->with('translations')->get();
        return view('admin.city._table' , compact('cities', 'state_id'));
    }

    public function add(){
        // dd('jdf');
        return view('admin.city._create');
    }

    public function store(Request $request)
    {
        try {
            // Validate the incoming request
            $validator = Validator::make($request->all(), [
                'name_en' => 'required|unique:city_translations,city_name',
                'name_hi' => 'required|unique:city_translations,city_name',
            ]);

            if ($validator->fails()) {
                return back()->withErrors($validator)->withInput();
            }

            // Create the main `City` entry
            $city = City::create([
                'state_id' => $request->state_id,
            ]);

            // Attach translations to the city
            $city->translations()->insert([
                [
                    'city_id' => $city->id,
                    'locale' => 'en', // English translation
                    'city_name' => $request->name_en,
                    'city_slug' => Str::slug($request->name_en),
                ],
                [
                    'city_id' => $city->id,
                    'locale' => 'hi', // Hindi translation
                    'city_name' => $request->name_hi,
                    'city_slug' => Str::slug($request->name_hi),
                ],
            ]);
            return redirect()->back()->with('success', 'City Created Successfully');
        } catch (\Throwable $th) {
            // Log the error for debugging purposes
            // \Log::error('Error creating city: ' . $th->getMessage());
            dd($th);

            return back()->with('error', 'Something went wrong! Please try again.');
        }
    }

    public function edit($id)
    {
        try {
            $city = City::with('translations')->findOrFail($id);
            return view('admin.city._edit', compact('city'));
        } catch (ModelNotFoundException $e) {
            // Handle case where the City is not found
            return back()->with('error', 'City not found.');
        }
    }
    public function update(Request $request, $id)
    {
        try {
            $city = City::with('translations')->findOrFail($id);

            // Validate the request
            $validator = Validator::make($request->all(), [
                'name_en' => 'required|string',
                'name_hi' => 'required|string',
            ]);
            if ($validator->fails()) {
                return back()->withErrors($validator)->withInput();
            }

            // Update the translations
            $city->translations()->updateOrCreate(
                ['locale' => 'en'],
                [
                    'city_name' => $request->name_en,
                    'city_slug' => Str::slug($request->name_en),
                ]
            );

            $city->translations()->updateOrCreate(
                ['locale' => 'hi'],
                [
                    'city_name' => $request->name_hi,
                    'city_slug' => Str::slug($request->name_hi),
                ]
            );

            return redirect()->route('admin.city.index', ['state_id' => $city->state_id])->with('success', 'City updated successfully.');
        } catch (ModelNotFoundException $e) {
            // Handle case where the City is not found
            return back()->with('error', 'City not found.');
        } catch (\Exception $e) {
            // Handle other exceptions

            return back()->with('error', 'Failed to update City: ' . $e->getMessage());
        }
    }

    public function destroy($id)
    {
        try {
            $city = City::findOrFail($id);
            $city->delete();

            // Redirect with success message
            return back()->with('success', 'City deleted successfully.');
        } catch (ModelNotFoundException $e) {
            // Handle case where the City is not found
            return back()->with('error', 'PermCityission not found.');
        } catch (\Exception $e) {
            // Handle other exceptions
            return back()->with('error', 'Failed to delete City: ' . $e->getMessage());
        }
    }


}
