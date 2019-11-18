<?php
//точка локального мінімуму
//градієнтний метод з поділом кроку навпіл
// start point = kg + 2,2 (68 + 2,2), h = 1
define('START_X', 70);
define('START_Y', 2);
define('H', 1);
define('E', 0.01);
function f($x, $y)
{
    return pow($x,2) + pow($y,2) -2 * 68 * $x + 6;
}
function dx($x, $y)
{
    return 2 * $x  - 2 * 68;
}
function dy($x, $y)
{
    return  2 * $y;
}
function grad($x,$y)
{
    return sqrt(pow(dx($x,$y),2) + pow(dy($x, $y),2));
}

function findMin2($x, $y, $step)
{
    $xNew = $x;
    $yNew = $y;
    $step = $step / 2;
    while (abs(grad($xNew,$yNew)) > E) {
        while (true) {
            $fstart = f($xNew,$yNew);
            $xNew = $xNew - $step * dx($xNew,$yNew);
            $yNew = $yNew - $step * dy($xNew, $yNew);

            if ($fstart <= f($xNew, $yNew)  ) break;
        }
        $step = $step / 2;
    }

    return [$xNew, $yNew];
}

[$x, $y] = findMin2(START_X, START_Y,H);

echo "Gradient method minimum point: ($x,$y), value:".f($x,$y);