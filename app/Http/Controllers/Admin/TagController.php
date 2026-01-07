<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Tag;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str ;

class TagController extends Controller
{
    public function index()
    {
        $tags = Tag::with('translations')->get();
        return view('admin.tag._table' , compact('tags'));
    }
    public function add()
    {
        return view('admin.tag._create');
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
            $tag = Tag::create([
                'created_by' => auth('admin')->user()->id,
            ]);

            // Attach translations to the city
            $tag->translations()->createMany([
                [
                    'locale' => 'en',
                    'tag_name' => $request->name_en,
                    'tag_slug' => Str::slug($request->name_en),
                ],
                [
                    'locale' => 'hi',
                    'tag_name' => $request->name_hi,
                    'tag_slug' => Str::slug($request->name_hi),
                ],
            ]);
            return redirect()->route('admin.tags.index')->with('success', 'Tag Created Successfully');
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
            $tag = Tag::with('translations')->findOrFail($id);
            return view('admin.tag._edit', compact('tag'));
        } catch (ModelNotFoundException $e) {
            // Handle case where the Tag is not found
            return back()->with('error', 'Tag not found.');
        }
    }
    public function update(Request $request, $id)
    {
        try {
            // Validate the incoming request
            $validator = Validator::make($request->all(), [
                'name_en' => 'required|string',
                'name_hi' => 'required|string',
            ]);

            if ($validator->fails()) {
                return back()->withErrors($validator)->withInput();
            }

            // Find the Tag and update it
            $tag = Tag::findOrFail($id);
            $tag->translations()->updateOrCreate(
                ['locale' => 'en'],
                [
                    'tag_name' => $request->name_en,
                    'tag_slug' => Str::slug($request->name_en),
                ]
            );
            $tag->translations()->updateOrCreate(
                ['locale' => 'hi'],
                [
                    'tag_name' => $request->name_hi,
                    'tag_slug' => Str::slug($request->name_hi),
                ]
            );

            return redirect()->route('admin.tags.index')->with('success', 'Tag updated successfully.');
        } catch (ModelNotFoundException $e) {
            // Handle case where the Tag is not found
            return back()->with('error', 'Tag not found.');
        } catch (\Exception $e) {
            // Handle other exceptions
            return back()->with('error', 'Failed to update Tag: ' . $e->getMessage());
        }
    }

    public function destroy($id)
    {
        try {
            $tag = Tag::findOrFail($id);
            $tag->delete();

            // Redirect with success message
            return back()->with('success', 'Tag deleted successfully.');
        } catch (ModelNotFoundException $e) {
            // Handle case where the Tag is not found
            return back()->with('error', 'tag not found.');
        } catch (\Exception $e) {
            // Handle other exceptions
            return back()->with('error', 'Failed to delete Tag: ' . $e->getMessage());
        }
    }


}
