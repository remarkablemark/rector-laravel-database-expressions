<?php

declare(strict_types=1);

use Illuminate\Support\Facades\DB;

DB::select('select 1');

DB::select(
    'select 2'
);

$db->select('select 3');

DB::raw('select 4');

function select5() {
    DB::select('select 5');
    $db->select('select 5');
}

DB::select(DB::raw('select 6'));

DB::select(
    DB::raw('select 7')
);

$db->select(DB::raw('select 8'));

$orders = DB::table('orders')
    ->select('department', DB::raw('SUM(price) as total_sales'))
    ->groupBy('department')
    ->havingRaw('SUM(price) > ?', [2500])
    ->get();
