<?php

$conf = [
    "widgets" => [
        'maincontent.topTiles' => [
            'grid' => "1",
            'tpl' => "NullosAdmin/Main/TopTiles/default",
            'conf' => [],
        ],
        'maincontent.dashboardGraph' => [
            'tpl' => "NullosAdmin/Main/Stat/DashboardGraph/default",
            'conf' => [],
        ],
        'maincontent.statProgressBars' => [
            'grid' => "1/3",
            'tpl' => "NullosAdmin/Main/Stat/ProgressBars/default",
            'conf' => [],
        ],
        'maincontent.statDoughnut' => [
            'grid' => "1/3",
            'tpl' => "NullosAdmin/Main/Stat/Doughnut/default",
            'conf' => [],
        ],
        'maincontent.statGauge' => [
            'grid' => "1/3",
            'tpl' => "NullosAdmin/Main/Stat/Gauge/default",
            'conf' => [],
        ],
    ],
    "grid" => ['maincontent'],
];