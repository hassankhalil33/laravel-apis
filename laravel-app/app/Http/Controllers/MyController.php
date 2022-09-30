<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MyController extends Controller {
    
    function sortedString(Request $request) {
        $myStr = $request -> input("string");
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

    // ASSUMED INPUT IS INTEGER 
    function placeValue(Request $request) {
        $num = $request -> input("num");
        $positive = true;
        if ($num < 0) {
            $positive = false;
            $num *= -1;
        }

        $arr = [];
        $myStr = strval($num);
        $length = strlen($myStr);
        $index = 0;

        for ($i = $length - 1; $i > 0; $i--) {
            if (str_split($myStr)[$index] == "0") {
                if (!$positive) {
                    $arr[] = intval("-" . str_split($myStr)[$index]);
                } else {
                    $arr[] = intval(str_split($myStr)[$index]);
                }
            } else {
                if (!$positive) {
                    $arr[] = intval("-" . str_split($myStr)[$index] . str_repeat("0", $i));
                } else {
                    $arr[] = intval(str_split($myStr)[$index] . str_repeat("0", $i));
                }
            }
            $index++;
        }

        if (!$positive) {
            $arr[] = intval("-" . str_split($myStr)[array_key_last(str_split($myStr))]);
        } else {
            $arr[] = intval(str_split($myStr)[array_key_last(str_split($myStr))]);
        }
        
        return response() -> json([
            "status" => "Success",
            "message" => $arr
        ]);
    }

    function toComputerCode(Request $request) {
        $myStr = $request -> input("string");
        $regExp = "/[0-9]+/";
        $finalString = "";

        $finalString = preg_replace_callback($regExp, function ($matches) {
            foreach ($matches as $match) {
                return decbin($match);
            }
        }, $myStr);

        return response() -> json([
            "status" => "Success",
            "message" => $finalString
        ]);
    }

    function evaluatePrefixExpression(Request $request) {
        

        return response() -> json([
            "status" => "Success",
            "message" => $finalString
        ]);
    }
}
