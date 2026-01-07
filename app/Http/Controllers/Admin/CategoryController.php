<?php

namespace App\Http\Controllers\Admin;

use App\CentralLogics\PermissionName AS Pn;
use App\Http\Controllers\Controller;
use App\Models\Category;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Intervention\Image\Laravel\Facades\Image;
use Spatie\Permission\Models\Role;

use function Laravel\Prompts\error;

class CategoryController extends Controller
{
    public function __construct()
    {


        // $this->middleware('permission:'.Pn::VIEW_CATEGORIES)->only(['index']);
        // $this->middleware('permission:'.Pn::CREATE_CATEGORIES)->only(['add', 'store']);
        // $this->middleware('permission:'.Pn::UPDATE_CATEGORIES)->only(['edit', 'update']);
        // $this->middleware('permission:'.Pn::DELETE_CATEGORIES)->only(['destroy']);
    }
    public function index(){
        $user = auth('admin')->user();
        // dd($user->getRoleNames());
        // dd($user->getAllPermissions()->toArray());

        $this->middleware('admin_auth');
        // dd(Pn::VIEW_CATEGORIES);

        $categories = Category::with('translations')->get();

        return view('admin.category._table' , compact('categories'));
    }
    public function add(){
        return view('admin.category._add');
    }

    public function store(Request $request)
    {
        try {
            //code...
            $validator = Validator::make($request->all(), [
                'name_en' => 'required|unique:category_translations,category_name',
                'name_hi' => 'required|unique:category_translations,category_name',
                'category_photo' => 'required|image|mimes:png,jpg,jpeg',
            ]);


            if($validator->fails()){
                return back()->withErrors($validator)->withInput();
            }else{
                // Category Photo Upload
                $category_photo_name =  "category-photo-".Str::random(5).".". $request->file('category_photo')->getClientOriginalExtension();
                $uploadDir = public_path('public/uploads/category_photo/');

                if (!File::exists($uploadDir)) {
                    File::makeDirectory($uploadDir, 0755, true); // Create the directory if it doesn't exist
                }

                $upload_link = $uploadDir . $category_photo_name;

                // $upload_link = base_path("public/uploads/category_photo/").$category_photo_name;
                $image = Image::read($request->file('category_photo'));
                $image->scaleDown(150, 150);
                $image->save($upload_link);

                // Insert the category into the `categories` table
                $category = Category::create([
                    'category_photo' => $category_photo_name,
                    'created_by' => auth('admin')->id(),
                ]);

                // Insert translations into the `category_translations` table
                $category->translations()->createMany([
                    [
                        'locale' => 'en', // English translation
                        'category_name' => $request->name_en,
                        'category_slug' => Str::slug($request->name_en),
                    ],
                    [
                        'locale' => 'hi', // Hindi translation
                        'category_name' => $request->name_hi,
                        'category_slug' => Str::slug($request->name_hi),
                    ],
                ]);

                return redirect()->route('admin.category.index')->with('success','Category Created');
            }
        } catch (\Throwable $th) {
            //throw $th;
            dd($th);
        }
    }

    public function edit($id)
    {
        try {
            $category = Category::with('translations')->findOrFail($id);
            return view('admin.category._edit', compact('category'));
        } catch (ModelNotFoundException $e) {
            // Handle case where the Category is not found
            return back()->with('error', 'Category not found.');
        }
    }
    public function update(Request $request, $id)
    {
        try {
            $category = Category::with('translations')->findOrFail($id);

            // Validate the request
            $validator = Validator::make($request->all(), [
                'name_en' => 'required|string',
                'name_hi' => 'required|string',
                'category_photo' => 'nullable|image|mimes:png,jpg,jpeg',
            ]);
            if ($validator->fails()) {
                return back()->withErrors($validator)->withInput();
            }
            // Update the category photo if provided
            if ($request->hasFile('category_photo')) {
                $category_photo_name =  "category-photo-".Str::random(5).".". $request->file('category_photo')->getClientOriginalExtension();
                $uploadDir = public_path('public/uploads/category_photo/');

                $upload_link = $uploadDir . $category_photo_name;
                $image = Image::read($request->file('category_photo'));
                $image->scaleDown(150, 150);
                $image->save($upload_link);
            }
            // Update the category in the `categories` table
            $category->update([
                'category_photo' => $request->hasFile('category_photo') ? $category_photo_name : $category->category_photo,
                'updated_by' => auth('admin')->id(),
            ]);
            // Update translations in the `category_translations` table
            $category->translations()->updateOrCreate(
                ['locale' => 'en'],
                [
                    'category_name' => $request->name_en,
                    'category_slug' => Str::slug($request->name_en),
                ]
            );
            $category->translations()->updateOrCreate(
                ['locale' => 'hi'],
                [
                    'category_name' => $request->name_hi,
                    'category_slug' => Str::slug($request->name_hi),
                ]
            );
            // Redirect with success message
            return redirect()->route('admin.category.index')->with('success', 'Category updated successfully.');
        } catch (ModelNotFoundException $e) {
            // Handle case where the Category is not found
            return back()->with('error', 'Category not found.');
        } catch (\Exception $e) {
            // Handle other exceptions
            return back()->with('error', 'Failed to update Category: ' . $e->getMessage());
        }
    }

    public function destroy($id)
    {
        try {
            $category = Category::findOrFail($id);
            $category->delete();

            // Redirect with success message
            return back()->with('success', 'Category deleted successfully.');
        } catch (ModelNotFoundException $e) {
            // Handle case where the Category is not found
            return back()->with('error', 'PermCategoryission not found.');
        } catch (\Exception $e) {
            // Handle other exceptions
            return back()->with('error', 'Failed to delete Category: ' . $e->getMessage());
        }
    }
}
