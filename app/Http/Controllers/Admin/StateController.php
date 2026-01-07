<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\State;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str ;

class StateController extends Controller
{
    public function index()
    {
        $states = State::with('translations')->get();
        return view('admin.state._table' , compact('states'));
    }

    public function add(){
        // dd('jdf');
        return view('admin.state._create');
    }

    public function store(Request $request)
    {
        try {
            // Validate the incoming request
            $validator = Validator::make($request->all(), [
                'name_en' => 'required|unique:state_translations,state_name',
                'name_hi' => 'required|unique:state_translations,state_name',
            ]);

            if ($validator->fails()) {
                dd($validator->errors());
                return back()->withErrors($validator)->withInput();
            }

            // Create the main `State` entry
            $state = State::create();

            // Attach translations to the state
            $state->translations()->insert([
                [
                    'state_id' => $state->id,
                    'locale' => 'en', // English translation
                    'state_name' => $request->name_en,
                    'state_slug' => Str::slug($request->name_en),
                ],
                [
                    'state_id' => $state->id,
                    'locale' => 'hi', // Hindi translation
                    'state_name' => $request->name_hi,
                    'state_slug' => Str::slug($request->name_hi),
                ],
            ]);
            return redirect()->route('admin.state.index')->with('success', 'State Created Successfully');
        } catch (\Throwable $th) {
            dd($th);
            // Log the error for debugging purposes
            Log::error('Error creating state: ' . $th->getMessage());
            return back()->with('error', 'Something went wrong! Please try again.');
        }
    }

    public function edit($id)
    {
        try {
            $state = State::with('translations')->findOrFail($id);
            return view('admin.state._edit', compact('state'));
        } catch (ModelNotFoundException $e) {
            return back()->with('error', 'State not found.');
        }
    }
    public function update(Request $request, $id)
    {
        try {
            $state = State::with('translations')->findOrFail($id);

            // Validate the request
            $validator = Validator::make($request->all(), [
                'name_en' => 'required|string',
                'name_hi' => 'required|string',
            ]);
            if ($validator->fails()) {
                return back()->withErrors($validator)->withInput();
            }

            // Update the translations
            $state->translations()->updateOrCreate(
                ['locale' => 'en'],
                [
                    'state_name' => $request->name_en,
                    'state_slug' => Str::slug($request->name_en),
                ]
            );

            $state->translations()->updateOrCreate(
                ['locale' => 'hi'],
                [
                    'state_name' => $request->name_hi,
                    'state_slug' => Str::slug($request->name_hi),
                ]
            );

            return redirect()->route('admin.state.index')->with('success', 'State updated successfully.');
        } catch (ModelNotFoundException $e) {
            return back()->with('error', 'State not found.');
        } catch (\Exception $e) {
            return back()->with('error', 'Failed to update State: ' . $e->getMessage());
        }
    }

    public function destroy($id)
    {
        try {
            $state = State::findOrFail($id);
            $state->delete();

            return back()->with('success', 'State deleted successfully.');
        } catch (ModelNotFoundException $e) {
            return back()->with('error', 'State not found.');
        } catch (\Exception $e) {
            return back()->with('error', 'Failed to delete State: ' . $e->getMessage());
        }
    }


}
