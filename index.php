<?php

// x^2 + 2kgx +k [-kg-2, kg+1], gk - 68 (розподілу інтервалу навпіл, точність пошуку 0.01), випадкового пошуку ( 100 точок)

define('E',0.01);
define('LEFT',-70);
define('RIGHT',69);
define('RANDOMIZE_COUNT', 100);


function f(float $x): float
{
    return pow($x,2) + 2 * 68 * $x + 6;
}

function getMinimumMethod1(float $left, float $right)
{
    $L = $right - $left;
    $xm = ($right + $left) / 2;

    do {
        //step2
        $wm = f($xm);
        $x1 = $left + $L/4;
        $x2 = $right - $L/4;
        $w1 = f($x1);
        $w2 = f($x2);

        //step3
        if ( $w1 < $wm ) {
            $right = $xm;
            $xm = $x1;
        } else {
            //step4
            if ( $w2 < $wm ) {
                $left = $xm;
                $xm = $x2;
            } else {
                $left = $x1;
                $right =$x2;
            }
        }
        //step5
        $L = $right - $left;
//        echo abs($L)."<br>";
    } while (abs($L) > E);

    return $xm;
}

function getMinimumMethod2(float $left, float $right)
{
    $arr = getRandomPoints();
    $values = [];
    foreach ($arr as $val) {
        $values[] =  ($right - $left) * $val + $left;
    }

    return min($values);
}

function getRandomPoints()
{
    $res = [];
    for($i = 0; $i < 100; $i++) {
        $res[] = mt_rand(0, 1);
    }
    sort($res);

    return $res;
}
$x1 = getMinimumMethod1(LEFT, RIGHT);
$x2 = getMinimumMethod2(LEFT, RIGHT);

echo "half-divide method finds point: $x1, value: ".f($x1)."<br>";
echo "Random method finds point : $x2, value: ".f($x2);
