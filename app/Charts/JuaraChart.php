<?php

namespace App\Charts;

use ArielMejiaDev\LarapexCharts\LarapexChart;


class JuaraChart
{
    protected $chart;

    public function __construct(LarapexChart $chart)
    {
        $this->chart = $chart;
    }

    public function build(): \ArielMejiaDev\LarapexCharts\DonutChart
    {

            $juara = Sertifikat::get();
            $data = [
                $juara->where('sf_juara', 'Juara 1')-> count(),
                $juara->where('sf_juara', 'Juara 2')-> count(),
                $juara->where('sf_juara', 'Juara 3')-> count(),

            ];

            $label = [
                'Juara 1',
                'Juara 2',
                'Juara 3',
            ];

        return $this->chart->donutChart()
            ->setTitle('Data Juara')
            ->setSubtitle(date('Y'))
            ->addData($data)
            ->setLabels($label);
    }
}
