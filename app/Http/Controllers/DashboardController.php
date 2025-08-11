<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Occurrence;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;


class DashboardController extends Controller
{
    public function getRecentOccurrences()
    {
        $recentOccurrences = Occurrence::orderBy('created_at', 'desc')
            ->take(5)
            ->get();

        $now = Carbon::now();
        $fourDaysAgo = $now->copy()->subDays(4)->startOfDay();

        $dailyCounts = Occurrence::select(
            DB::raw('DATE(created_at) as date'),
            DB::raw('COUNT(*) as count')
        )
            ->whereBetween('created_at', [$fourDaysAgo, $now])
            ->groupBy(DB::raw('DATE(created_at)'))
            ->orderBy(DB::raw('DATE(created_at)'), 'asc')
            ->get();

        return response()->json([
            'recentOccurrences' => $recentOccurrences,
            'dailyCounts' => $dailyCounts
        ]);
    }
}
