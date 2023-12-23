<?php

declare(strict_types=1);

use Illuminate\Support\Facades\DB;

DB::select(DB::raw('select 1'));

DB::select(
    DB::raw('select 2')
);

$orders = DB::table('orders')
    ->selectRaw(DB::raw('price * ? as price_with_tax'), [1.0825])
    ->get();

$orders = DB::table('orders')
    ->whereRaw(DB::raw('price > IF(state = "TX", ?, 100)'), [200])
    ->get();
-----
<?php

declare(strict_types=1);

use Illuminate\Support\Facades\DB;

DB::select(DB::raw('select 1')->getValue(DB::getQueryGrammar()));

DB::select(
    DB::raw('select 2')->getValue(DB::getQueryGrammar())
);

$orders = DB::table('orders')
    ->selectRaw(DB::raw('price * ? as price_with_tax')->getValue(DB::getQueryGrammar()), [1.0825])
    ->get();

$orders = DB::table('orders')
    ->whereRaw(DB::raw('price > IF(state = "TX", ?, 100)')->getValue(DB::getQueryGrammar()), [200])
    ->get();
