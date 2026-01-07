<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\City;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Session;
use Laravel\Socialite\Facades\Socialite;

class UserController extends Controller
{
    public function signUpUser(Request $request)
    {
        // dd($request->all());
        try {
            $validatedData = $request->validate([
                'user_name' => 'required|string|max:255',
                'user_email' => 'required|email|max:255|unique:users,email',
                'user_phone' => 'required|string|max:15',
                'password' => 'required|string|min:6|confirmed',
            ]);

            // Assuming you have a User model
            $user = new User();
            $user->name = $validatedData['user_name'];
            $user->email = $validatedData['user_email'];
            $user->phone_number = $validatedData['user_phone'];
            $user->password = bcrypt($validatedData['password']);
            $user->save();
            Auth::guard('web')->login($user, true);
            return response()->json(['message' => 'User signed up successfully'], 201)
                ->header('Remember-Token', 'true');
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json(['errors' => $e->errors()], 422);
        }
    }

    public function loginUser(Request $request)
    {
        try {
            $credentials = $request->validate([
                'email' => 'required|email',
                'password' => 'required|string',
                'remember_me' => 'boolean',
            ]);

            if (Auth::attempt(['email' => $credentials['email'], 'password' => $credentials['password']], $request->remember_me)) {
                $user = Auth::user();
                return response()->json(['message' => 'Login successful', 'user' => $user], 200);
            } else {
                return response()->json(['message' => 'Invalid credentials'], 401);
            }
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json(['errors' => $e->errors()], 422);
        }
    }

    public function logOutUser(Request $request)
    {
        Auth::guard('web')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('user.home');
    }

    public function loginWithGoogle()
    {
        // dd(env('GOOGLE_CLIENT_ID'));
        return Socialite::driver('google')->redirect();
    }

    public function authWithGoogle()
    {
        $googleUser = Socialite::driver('google')->user();

        $user = User::updateOrCreate([
            'email' => $googleUser->getEmail(),
        ], [
            'name' => $googleUser->getName(),
            'google_id' => $googleUser->getId(),
            'avatar' => $googleUser->getAvatar(),
            'password' => bcrypt(uniqid()), // Random password (not used for Google login)
            'last_active' => Carbon::now(),
            'email_verified_at' => Carbon::now(),
        ]);
        Auth::guard('web')->login($user, true);
        return redirect()->route('user.home');

        // Auth::login($user);
    }

    /*public function setLocation(Request $request){
        $locale = app()->getLocale(); // Get the current application localed
        $c_query = $request->query('city')??"all";

        $city = City::whereHas('translations', function ($query) use ($c_query, $locale) {
            $query->where('locale', $locale)
                  ->where('city_slug', 'LIKE', "%{$c_query}%");
        })->first();
        // dd($city);
        Session::put('city', $city);
        return back();
    }*/
    public function setLocation(Request $request)
    {
        $locale = app()->getLocale();
        $c_query = $request->query('city') ?? 'all';

        // Create a global cache key based on query and locale
        $cacheKey = "city_cache:{$locale}:" . md5($c_query);

        // Use Redis to globally cache the city for 30 minutes
        $city = Cache::store('redis')->remember($cacheKey, now()->addMinutes(30), function () use ($c_query, $locale) {
            return City::whereHas('translations', function ($query) use ($c_query, $locale) {
                $query->where('locale', $locale)
                    ->where('city_slug', 'LIKE', "%{$c_query}%");
            })->first();
        });

        // Save city to session (not cached — this is user-specific)
        Session::put('city', $city);

        return back();
    }

    public function privacyPolicy()
    {
        return view('user.privacy-policy');
    }
    public function termsAndConditions()
    {
        return view('user.terms-and-conditions');
    }
}
