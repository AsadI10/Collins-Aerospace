<?php
/*
$tol = 0.04;
$geo = [[-5.098,53.41],[-5.1,53.455],[-5.093,53.455],[-5.087,53.455],[-5.086,53.455],[-5.08,53.455],[-5.079,53.455],[-5.073,53.455],[-5.072,53.455],[-5.066,53.455],[-5.059,53.456],[-5.058956,53.455006],[-5.052994,53.455858],[-5.053,53.456],[-5.052,53.456],[-5.046,53.456],[-5.045,53.456],[-5.039,53.456],[-5.038,53.456],[-5.032,53.456],[-5.026,53.456],[-5.025,53.456],[-5.019,53.456],[-5.018,53.456],[-5.012,53.456],[-5.011,53.456],[-5.005,53.456],[-4.998991,53.456858],[-4.999,53.457],[-4.998,53.457],[-4.992,53.457],[-4.991,53.457],[-4.985,53.457],[-4.984,53.457],[-4.978,53.457],[-4.977,53.457],[-4.971,53.457],[-4.965,53.457],[-4.964,53.457],[-4.958,53.457],[-4.957,53.457],[-4.951,53.457],[-4.95,53.457],[-4.944,53.457],[-4.937994,53.457858],[-4.938,53.458],[-4.937,53.458],[-4.931,53.458],[-4.93,53.458],[-4.924,53.458],[-4.923,53.458],[-4.917,53.458],[-4.916,53.458],[-4.91,53.458],[-4.904,53.458],[-4.903,53.458],[-4.897,53.458],[-4.896,53.458],[-4.89,53.458],[-4.889,53.458],[-4.883,53.458],[-4.876994,53.458858],[-4.877,53.459],[-4.876,53.459],[-4.87,53.459],[-4.869,53.459],[-4.863,53.459],[-4.862,53.459],[-4.856,53.459],[-4.849,53.459],[-4.843,53.459],[-4.842,53.459],[-4.835,53.459],[-4.833,53.414],[-4.84,53.414],[-4.841,53.414],[-4.847,53.414],[-4.848,53.414],[-4.854,53.414],[-4.86,53.414],[-4.861,53.414],[-4.867,53.414],[-4.868,53.414],[-4.874,53.414],[-4.881,53.413],[-4.881044,53.413994],[-4.887006,53.413142],[-4.887,53.413],[-4.888,53.413],[-4.894,53.413],[-4.895,53.413],[-4.901,53.413],[-4.902,53.413],[-4.908,53.413],[-4.914,53.413],[-4.915,53.413],[-4.921,53.413],[-4.922,53.413],[-4.928,53.413],[-4.929,53.413],[-4.935,53.413],[-4.936,53.413],[-4.942,53.413],[-4.948006,53.412142],[-4.948,53.412],[-4.949,53.412],[-4.955,53.412],[-4.956,53.412],[-4.962,53.412],[-4.963,53.412],[-4.969,53.412],[-4.975,53.412],[-4.976,53.412],[-4.982,53.412],[-4.983,53.412],[-4.989,53.412],[-4.99,53.412],[-4.996,53.412],[-5.002,53.412],[-5.009006,53.411124],[-5.009,53.411],[-5.01,53.411],[-5.016,53.411],[-5.017,53.411],[-5.023,53.411],[-5.029,53.411],[-5.03,53.411],[-5.036,53.411],[-5.037,53.411],[-5.043,53.411],[-5.044,53.411],[-5.05,53.411],[-5.051,53.411],[-5.057,53.411],[-5.063006,53.410142],[-5.063,53.41],[-5.064,53.41],[-5.07,53.41],[-5.071,53.41],[-5.077,53.41],[-5.078,53.41],[-5.084,53.41],[-5.09,53.41],[-5.091,53.41],[-5.098,53.41]];
*/
function simplify_RDP($vertices, $tolerance) {
    var_dump($vertices);
    // if this is a multilinestring, then we call ourselves one each segment individually, collect the list, and return that list of simplified lists
    if (is_array($vertices[0][0])) {
        $multi = array();
        foreach ($vertices as $subvertices) $multi[] = simplify_RDP($subvertices,$tolerance);
        return $multi;
    }

    $tolerance2 = $tolerance * $tolerance;

    // okay, so this is a single linestring and we simplify it individually
    return _segment_RDP($vertices,$tolerance2);
}

function _segment_RDP($segment, $tolerance_squared) {
    if (sizeof($segment) <= 2) return $segment; // segment is too small to simplify, hand it back as-is

    // find the maximum distance (squared) between this line $segment and each vertex
    // distance is solved as described at UCSD page linked above
    // cheat: vertical lines (directly north-south) have no slope so we fudge it with a very tiny nudge to one vertex; can't imagine any units where this will matter
    $startx = (float) $segment[0][0];
    $starty = (float) $segment[0][1];
    $endx   = (float) $segment[ sizeof($segment)-1 ][0];
    $endy   = (float) $segment[ sizeof($segment)-1 ][1];
    if ($endx == $startx) $startx += 0.00001;
    $m = ($endy - $starty) / ($endx - $startx); // slope, as in y = mx + b
    $b = $starty - ($m * $startx);              // y-intercept, as in y = mx + b

    $max_distance_squared = 0;
    $max_distance_index   = null;
    for ($i=1, $l=sizeof($segment); $i<=$l-2; $i++) {
        $x1 = $segment[$i][0];
        $y1 = $segment[$i][1];

        $closestx = ( ($m*$y1) + ($x1) - ($m*$b) ) / ( ($m*$m)+1);
        $closesty = ($m * $closestx) + $b;
        $distsqr  = ($closestx-$x1)*($closestx-$x1) + ($closesty-$y1)*($closesty-$y1);

        if ($distsqr > $max_distance_squared) {
            $max_distance_squared = $distsqr;
            $max_distance_index   = $i;
        }
    }

    // cleanup and disposition
    // if the max distance is below tolerance, we can bail, giving a straight line between the start vertex and end vertex   (all points are so close to the straight line)
    if ($max_distance_squared <= $tolerance_squared) {
        return array($segment[0], $segment[ sizeof($segment)-1 ]);
    }
    // but if we got here then a vertex falls outside the tolerance
    // split the line segment into two smaller segments at that "maximum error vertex" and simplify those
    $slice1 = array_slice($segment, 0, $max_distance_index);
    $slice2 = array_slice($segment, $max_distance_index);
    $segs1 = _segment_RDP($slice1, $tolerance_squared);
    $segs2 = _segment_RDP($slice2, $tolerance_squared);
    return array_merge($segs1,$segs2);
}
?>