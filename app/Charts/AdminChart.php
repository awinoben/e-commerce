<?php

declare(strict_types=1);

namespace App\Charts;

use App\Models\History;
use App\Models\Order;
use Carbon\Carbon;
use Chartisan\PHP\Chartisan;
use ConsoleTVs\Charts\BaseChart;
use Illuminate\Http\Request;

class AdminChart extends BaseChart
{
    /**
     * Handles the HTTP request for the given chart.
     * It must always return an instance of Chartisan
     * and never a string or an array.
     * @param Request $request
     * @return Chartisan
     */
    public function handler(Request $request): Chartisan
    {
        // get current date
        $today_order = (int)now()->parse(today())->format('d');
        $today_history = (int)now()->parse(today())->format('d');

        // set the filter here
        $orders = Order::query()
            ->oldest()
            ->whereBetween('created_at', [now()->subDays(7), now()])
            ->get()
            ->groupBy(fn($val) => Carbon::parse($val->created_at)->format('d'));

        $histories = History::query()
            ->oldest()
            ->whereBetween('created_at', [now()->subDays(7), now()])
            ->get()
            ->groupBy(fn($val) => Carbon::parse($val->created_at)->format('d'));

        return Chartisan::build()
            ->labels(['Day 1', 'Day 2', 'Day 3', 'Day 4', 'Day 5', 'Day 6', 'Day 7'])
            ->dataset('Orders', [
                isset($orders[$today_order - 6]) ? count($orders[$today_order - 6]) : 0,
                isset($orders[$today_order - 5]) ? count($orders[$today_order - 5]) : 0,
                isset($orders[$today_order - 4]) ? count($orders[$today_order - 4]) : 0,
                isset($orders[$today_order - 3]) ? count($orders[$today_order - 3]) : 0,
                isset($orders[$today_order - 2]) ? count($orders[$today_order - 2]) : 0,
                isset($orders[$today_order - 1]) ? count($orders[$today_order - 1]) : 0,
                isset($orders[$today_order]) ? count($orders[$today_order]) : 0
            ])
            ->dataset('Sales', [
                isset($histories[$today_history - 6]) ? count($histories[$today_history - 6]) : 0,
                isset($histories[$today_history - 5]) ? count($histories[$today_history - 5]) : 0,
                isset($histories[$today_history - 4]) ? count($histories[$today_history - 4]) : 0,
                isset($histories[$today_history - 3]) ? count($histories[$today_history - 3]) : 0,
                isset($histories[$today_history - 2]) ? count($histories[$today_history - 2]) : 0,
                isset($histories[$today_history - 1]) ? count($histories[$today_history - 1]) : 0,
                isset($histories[$today_history]) ? count($histories[$today_history]) : 0
            ]);
    }
}
