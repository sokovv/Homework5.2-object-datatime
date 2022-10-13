<?php


function listWork(int $numberYear, int $numberMonth): void
{
    $datetime = new DateTime();
    $datetime->setDate($numberYear, $numberMonth, 1);

    echo '---График работы на ' . $datetime->format('F ') . '---' . PHP_EOL;

    $next_month = new DateTime();
    $next_month->setDate($numberYear, $numberMonth, 1);
    $interval = DateInterval::createFromDateString('1 month - 1 day');
    $next_month = $next_month->add($interval);

    function nextWorkDay($datetime, $next_month): object
    {
        $day_of_week = $datetime->format('N');

        if ($day_of_week > 5) {
            echo "Выходной: " . $datetime->format('d-D') . PHP_EOL;
            $datetime->add(new DateInterval('P1D'));
        }
        if ($day_of_week <= 5) {
            echo "Рабочий день: " . $datetime->format('d-D') . PHP_EOL;
            $datetime->add(new DateInterval('P1D'));
            if ($datetime < $next_month) {
                echo "Выходной: " . $datetime->format('d-D') . PHP_EOL;
            }
            $datetime->add(new DateInterval('P1D'));
            if ($datetime < $next_month) {
                echo "Выходной: " . $datetime->format('d-D') . PHP_EOL;
            }
            $datetime->add(new DateInterval('P1D'));
        }
        return $datetime;
    }
    while ($datetime < $next_month) {
        $datetime = nextWorkDay($datetime, $next_month);
    }
}

listWork(2022, 9);