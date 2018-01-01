<?php

/**
*  Fetch Last inserted ID in the Database
*  @return int 
*/
function lastId() {
    $last = DB::select(DB::raw('SELECT LAST_INSERT_ID()'));
    return collect($last[0])->toArray()["LAST_INSERT_ID()"];
}
