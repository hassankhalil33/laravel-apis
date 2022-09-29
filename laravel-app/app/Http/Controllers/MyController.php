<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MyController extends Controller {
    
    function sortedString($myStr) {
        $arr = [];
        $sortedString = "";

        foreach (str_split($myStr) as $l) {
            $arr[] = $l;
        }

        sort($arr);

        foreach ($arr as $i) {
            $sortedString .= $i;
        }

        return $sortedString;
    }
}
