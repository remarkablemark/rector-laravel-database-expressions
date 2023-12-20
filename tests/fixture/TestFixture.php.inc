<?php

declare(strict_types=1);

use Illuminate\Support\Facades\DB;

DB::select(DB::raw('select 1'));

DB::select(
    DB::raw('select 2')
);

$db->select(DB::raw('select 3'));
-----
<?php

declare(strict_types=1);

use Illuminate\Support\Facades\DB;

DB::select(DB::raw('select 1')->getValue(DB::getQueryGrammar()));

DB::select(
    DB::raw('select 2')->getValue(DB::getQueryGrammar())
);

$db->select(DB::raw('select 3')->getValue(DB::getQueryGrammar()));
