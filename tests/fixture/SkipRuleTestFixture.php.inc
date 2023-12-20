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
