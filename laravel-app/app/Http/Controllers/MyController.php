<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MyController extends Controller {
    
    function sortedString($myStr) {
        $arrSmall = [];
        $arrCap = [];
        $arrNum = [];
        $sortedString = "";

        foreach (str_split($myStr) as $l) {
            if ($l >= "A" and $l <= "Z") {
                $arrCap[] = $l;
            } else if ($l >= "a" and $l <= "z"){
                $arrSmall[] = $l;
            } else {
                $arrNum[] = $l;
            }
        }

        sort($arrSmall);
        sort($arrCap);
        sort($arrNum);

        for ($i = 0; $i < count($arrSmall); $i++) {
            if ($arrCap) {
                if ($arrSmall[$i] > strtolower($arrCap[0])) {
                    $sortedString .= $arrCap[0];
                    unset($arrCap[0]);
                    $arrCap = array_values($arrCap);
                }
            }
            $sortedString .= $arrSmall[$i];
        }

        if ($arrCap) {
            foreach ($arrCap as $cap) {
                $sortedString .= $cap;
            }
        }

        foreach ($arrNum as $num) {
            $sortedString .= $num;
        }

        return $sortedString;
    }
}
