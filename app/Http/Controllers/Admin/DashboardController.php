<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\News;
use App\Models\Visitor;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function dashboard(Request $request)
    {
        $filter = $request->query('filter', 'this_month');
        $now = Carbon::now() ;
        if($filter == 'custom'){
            $dateRange = $request->date_range;
            if($dateRange == null){
                return back()->with('info', "Date range can\'t be null");
            }
            $dates = explode(" to ", $dateRange);

            $from = $dates[0]??null;
            $to = $dates[1]??null;
            $startDate = $from;
            $endDate = $to;
        }else{
            if ($filter) {
                try {
                    $startDate = Carbon::createFromFormat('Y-m', $filter)->startOfMonth();
                    $endDate = Carbon::createFromFormat('Y-m', $filter)->endOfMonth();
                } catch (\Exception $e) {
                    $startDate = Carbon::now()->startOfMonth();
                    $endDate = Carbon::now()->endOfMonth();
                }
            } else {
                $startDate = Carbon::now()->startOfMonth();
                $endDate = Carbon::now()->endOfMonth();
            }
        }

        $v_query = DB::table('visitors');
        if ($request->start && $request->end) {
            $v_query->whereBetween('created_at', [$startDate, $endDate]);
        }
        $visitors = [
            'daily' =>$v_query->selectRaw('DATE(created_at) as label, COUNT(*) as total')
                    ->groupByRaw('DATE(created_at)')
                    ->orderBy('label')
                    ->get(),
            'weekly' => DB::table('visitors')
                    ->selectRaw("YEARWEEK(created_at, 1) as label, COUNT(*) as total")
                    ->groupByRaw("YEARWEEK(created_at, 1)")
                    ->orderBy('label')
                    ->get(),
            'monthly' => DB::table('visitors')
                    ->selectRaw("DATE_FORMAT(created_at, '%Y-%m') as label, COUNT(*) as total")
                    ->groupByRaw("DATE_FORMAT(created_at, '%Y-%m')")
                    ->orderBy('label')
                    ->get(),
        ];


        $data = [
            'visitors' => $visitors,
            'latest_news'=> News::with('translations')->whereBetween('created_at', [$startDate, $endDate])
                            ->isActive()->limit(5)->latest()->get(),
        ];

        return view('admin.dashboard',compact('data','now'));
    }
}
