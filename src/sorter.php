<?php

function bubble_sort(array $arr)
{
    if (count($arr) <= 1) {
        return $arr;
    }
    for ($i = 0; $i < count($arr); $i++) {
        for ($j = $i; $j < count($arr); $j++) {
            if ($arr[$i] > $arr[$j]) {
                $tmp = $arr[$i];
                $arr[$i] = $arr[$j];
                $arr[$j] = $tmp;
            }
        }
    }

    return $arr;
}

function insert_sort(array $arr)
{
    if (count($arr) <= 1) {
        return $arr;
    }
    for ($i = 0; $i < count($arr); $i++) {
        for ($j = 0; $j <= $i; $j++) {
            if ($arr[$i] < $arr[$j]) {
                $tmp = $arr[$j];
                $arr[$j] = $arr[$i];
                $arr[$i] = $tmp;
            }
        }
    }

    return $arr;
}

function selection_sort(array $arr)
{
    if (count($arr) <= 1) {
        return $arr;
    }
    for ($i = 0; $i < count($arr); $i++) {
        $min = $i;
        for ($j = $i; $j < count($arr); $j++) {
            if ($arr[$min] > $arr[$j]) {
                $min = $j;
            }
        }
        $tmp = $arr[$i];
        $arr[$i] = $arr[$min];
        $arr[$min] = $tmp;
    }

    return $arr;
}

/**
 * ----------------------------------------------
 * 归并排序
 * ----------------------------------------------
 */
function merge_sort(array $arr)
{
    $len = count($arr);
    if ($len <= 1) {
        return $arr;
    }

    $mid = (int)floor($len / 2);
    $arr = array_merge(merge_sort(array_slice($arr, 0, $mid)), merge_sort(array_slice($arr, $mid)));

    $tmp = [];
    $left = 0;
    $right = $mid;
    while ($left < $mid && $right <= $len - 1) {
        if ($arr[$left] < $arr[$right]) {
            $tmp[] = $arr[$left++];
        } else {
            $tmp[] = $arr[$right++];
        }
    }

    $offset = $right;
    $length = $len - $right;
    if ($right == $len) {
        $offset = $left;
        $length = $mid - $left;
    }
    return array_merge($tmp, array_slice($arr, $offset, $length));
}

function quick_sort(array $arr)
{
    $len = count($arr);
    if ($len <= 1) {
        return $arr;
    }
    $pivot = end($arr);
    $pivotIndex = key($arr);
    reset($arr);
    $left = key($arr);
    for ($i = 0; $i < $len - 1; $i++) {
        if ($arr[$i] < $pivot) {
            $value = $arr[$i];
            $arr[$i] = $arr[$left];
            $arr[$left] = $value;
            $left++;
        }
    }
    list($arr[$left], $arr[$pivotIndex]) = [$arr[$pivotIndex], $arr[$left]];

    return array_merge(quick_sort(array_slice($arr, 0, $left)), [$pivot], quick_sort(array_slice($arr, $left + 1)));
}

function bucket_sort(array $arr)
{
    if (count($arr) <= 1) {
        return $arr;
    }
    $mean = max($arr) / 100;
    // default 100 bucket
    $bucket = [];
    for ($i = 0; $i < 100; $i++) {
        $bucket[$i] = [];
    }
    foreach ($arr as $value) {
        $bucket[(int)floor($value / $mean)][] = $value;
    }
    foreach ($bucket as $key => $item) {
        $bucket[$key] = quick_sort($item);
    }

    return array_merge(...$bucket);
}

function counting_sort(array $arr)
{
    if (count($arr) <= 1) {
        return $arr;
    }
    $counting = [];
    $max = max($arr);
    for ($i = 0; $i <= $max; $i++) {
        $counting[$i] = 0;
    }
    foreach ($arr as $value) {
        $counting[$value] += 1;
    }
    for ($i = 1; $i <= $max; $i++) {
        $counting[$i] += $counting[$i - 1];
    }
    $tmp = [];
    for ($i = count($arr) - 1; $i >= 0; $i--) {
        $index = $counting[$arr[$i]] - 1;
        $tmp[$index] = $arr[$i];
        $counting[$arr[$i]]--;
    }
    foreach ($tmp as $key => $value) {
        $arr[$key] = $tmp[$key];
    }
    return $arr;
}

function radix_sort()
{
}
