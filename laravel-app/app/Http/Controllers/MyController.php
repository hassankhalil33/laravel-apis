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

        function mySort($arr) {
            for ($i = 0; $i < count($arr); $i++) {
                for ($j = 1; $j <= count($arr) - 1; $j++) {
                    if ($arr[$j - 1] > $arr[$j]) {
                        [$arr[$j - 1], $arr[$j]] = [$arr[$j], $arr[$j - 1]]; 
                        echo json_encode($arr);
                    }
                }
            }
            return $arr;
        }

        foreach (str_split($myStr) as $l) {
            if ($l >= "A" and $l <= "Z") {
                $arrCap[] = $l;
            } else if ($l >= "a" and $l <= "z"){
                $arrSmall[] = $l;
            } else {
                $arrNum[] = $l;
            }
        }

        $arrSmall = mySort($arrSmall);
        $arrCap = mySort($arrCap);
        $arrNum = mySort($arrNum);

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
        $input = $request -> input("expression");
        $myExp = explode(" ", $input);
        $operands = ["+", "-", "*", "/"];
        $stackOp = [];
        $stackNum = [];
        $i = 0;
        $total = 0;

        foreach ($myExp as $d) {
            if (in_array($d, $operands)) {
                $stackOp[] = $d;
                $i = 0;
            } else {
                $stackNum[] = $d;
                $i++;
            }

            if ($i == 2) {
                $last = array_pop($stackNum);
                $first = array_pop($stackNum);
                $operation = array_pop($stackOp);

                if ($operation == "+") {
                    $total = ((int)$first + (int)$last);
                } else if ($operation == "-") {
                    $total = ((int)$first - (int)$last);
                } else if ($operation == "*") {
                    $total = ((int)$first * (int)$last);
                } else {
                    $total = ((int)$first / (int)$last);
                }

                $i = 0;
            }
        }

        while ($stackNum) {
            $num = array_pop($stackNum);
            $operation = array_pop($stackOp);

            if ($operation == "+") {
                $total += (int)$num;
            } else if ($operation == "-") {
                $total -= (int)$num;
            } else if ($operation == "*") {
                $total *= (int)$num;
            } else {
                $total /= (int)$num;
            }
        }

        return response() -> json([
            "status" => "Success",
            "message" => $total
        ]);
    }
}
