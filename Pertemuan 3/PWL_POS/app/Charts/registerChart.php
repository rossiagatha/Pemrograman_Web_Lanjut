<?php

namespace App\Charts;

use App\Models\LevelModel;
use ArielMejiaDev\LarapexCharts\LarapexChart;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class registerChart
{
    protected $chart;

    public function __construct(LarapexChart $chart)
    {
        $this->chart = $chart;
    }

    public function build(): \ArielMejiaDev\LarapexCharts\LineChart
    {
        $levelMember = LevelModel::where('level_nama', 'Member')->first();
        $start = Carbon::now()->startOfMonth()->format('Y-m-d');

        
        $dataRaw = DB::select(
        "SELECT count(user_id) as count, DATE_FORMAT(u.created_at, '%W %d %M') as day 
        from m_user as u 
        where u.level_id =".$levelMember->level_id." and  u.created_at >=".$start."
        GROUP by day"
        );

        //parse array to collection
        $dataRaw = collect($dataRaw);
        //to hold processed data
        $processedData = collect();

        // dd(Carbon::now()->subDays(2)->format('l d F'), $dataRaw, (Int) Carbon::now()->format('d'));

        for ($i=0; $i < ((Int) Carbon::now()->format('d')); $i++) { 
            $comparisonDate =  Carbon::now()->subDays($i)->format('l d F');

            $existDate = $dataRaw->where('day', $comparisonDate);

            // if($i == 1) dd($existDate, $dataRaw, $comparisonDate, $comparisonDate == $dataRaw[$i]->day? true: false);

            if($existDate->isEmpty()){
                $processedData->prepend([
                    'count' => 0,
                    'day' => $comparisonDate
                ]);
            }else{
                $processedData->prepend([
                    'count' => $existDate->first()->count,
                    'day' => $existDate->first()->day
                ]);
            }
        }

        //Number of registrants
        $data =$processedData->pluck('count')->toArray();

        //Date
        $date = $processedData->pluck('day')->toArray();
        return $this->chart->lineChart()
            ->setTitle('Grafik Member')
            ->addData('Physical sales', $data)
            ->setXAxis($date);
    }
}
