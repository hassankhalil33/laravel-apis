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

        return response() -> json([
            "status" => "Success",
            "message" => $sortedString
        ]);
    }

    function placeValue($num) {
        $arr = [];
        $myStr = strval($num);
        $length = strlen($myStr);
        $index = 0;

        for ($i = $length - 1; $i > 0; $i--) {
            if (str_split($myStr)[$index] == "0") {
                $arr[] = str_split($myStr)[$index];
            } else {
                $arr[] = str_split($myStr)[$index] . str_repeat("0", $i);
            }
            
            $index++;
        }

        $arr[] = str_split($myStr)[array_key_last(str_split($myStr))];

        return response() -> json([
            "status" => "Success",
            "message" => $arr
        ]);
    }
}
