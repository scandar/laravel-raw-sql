<?php

/**
*  Fetch Last inserted ID in the Database
*  @return int
*/
function lastId() {
    $last = DB::select(DB::raw('SELECT LAST_INSERT_ID()'));
    return collect($last[0])->toArray()["LAST_INSERT_ID()"];
}

/**
*  convert object type to array
*  @param object $d
*  @return array
*/
function objectToArray($d) {
    if (is_object($d)) {
        // Gets the properties of the given object
        // with get_object_vars function
        $d = get_object_vars($d);
    }

    if (is_array($d)) {
        /*
        * Return array converted to object
        * Using __FUNCTION__ (Magic constant)
        * for recursive call
        */
        return array_map(__FUNCTION__, $d);
    }
    else {
        // Return array
        return $d;
    }
}
