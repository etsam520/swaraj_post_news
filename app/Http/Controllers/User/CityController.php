<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\City;
use App\Models\State;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redis;

class CityController extends Controller
{

    public function x_getStateCities()
    {
        $locale = app()->getLocale();


        return response()->json(State::with(
            ['cities' =>  function ($que1) use ($locale) {
                $que1->whereHas('translations', function ($query) use ($locale) {
                    $query->where('locale', $locale)
                        ->select('city_id', 'city_name');
                })->select('cities.id', 'cities.state_id');
            }]
        )->get());
    }

    public function getStateCities()
    {
        $locale = app()->getLocale();
        $cacheKey = "states_with_cities_locale_{$locale}";

        $data = Cache::remember($cacheKey, now()->addMinutes(30), function () use ($locale) {
            return State::with([
                'cities' => function ($query) use ($locale) {
                    $query->whereHas('translations', function ($q) use ($locale) {
                        $q->where('locale', $locale);
                    })->with(['translations' => function ($q) use ($locale) {
                        $q->where('locale', $locale)->select('city_id', 'city_name', 'locale');
                    }])->select('id', 'state_id');
                }
            ])->get();
        });

        return response()->json($data);
    }

    public function _DDgetStateCities()
    {
        $locale = app()->getLocale();


        $stat = State::with(['cities' => function ($query) use ($locale) {
            $query->join('city_translations', function ($join) use ($locale) {
                $join->on('cities.id', '=', 'city_translations.city_id')
                    ->where('city_translations.locale', '=', $locale);
            })
                ->addSelect('cities.id', 'cities.state_id', 'city_translations.city_name as city_name');
        },])->join('state_translations', function ($join) use ($locale) {
            $join->on('states.id', '=', 'state_translations.state_id')
                ->where('state_translations.locale', '=', $locale);
        })->addSelect('states.id', 'state_translations.state_name as state_name')
            ->get();
        // dd($stat);
        return response()->json($stat);
    }
    public function _X__getStateCities()
    {
        // dd();
        $locale = app()->getLocale();
        $states = DB::table('states')
            ->join('state_translations', function ($join) use ($locale) {
                $join->on('states.id', '=', 'state_translations.state_id')
                    ->where('state_translations.locale', '=', $locale);
            })
            ->join('cities', 'states.id', '=', 'cities.state_id')
            ->join('city_translations', function ($join) use ($locale) {
                $join->on('cities.id', '=', 'city_translations.city_id')
                    ->where('city_translations.locale', '=', $locale);
            })
            ->addSelect(
                'states.id as state_id',
                'state_translations.state_name as state_name',
                DB::raw("JSON_ARRAYAGG(
            JSON_OBJECT(
                'id', cities.id,
                'name', city_translations.city_name,
                'slug', city_translations.city_slug
            )
        ) AS cities")
            )
            ->groupBy('states.id', 'state_translations.state_name')
            ->get();
        dd($states);
        // return response()->json($state->get());

    }
}
