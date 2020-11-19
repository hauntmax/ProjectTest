<?php

function stringChallenge(string $str): bool {
    $arr = explode('???', $str);
    for ($id=0; $id<count($arr)-1; $id++){
        if (intval(strrev($arr[$id])) + intval($arr[$id+1]) == 10){
            return true;
        }
    }
    return false;
}

//function assertBool($str, $target) {
//    if (stringChallenge($str) !== $target) {
//        echo "Error on $str -> Should be " . (($target)?"true":"false") . "<br>";
//    } else {
//        echo "Passed: $str" . "<br>";
//    }
//}
//
//assertBool('2??9', false);
//assertBool('2???9', false);
//assertBool('1???9', true);
//assertBool('???9', false);
//assertBool('2???', false);
//assertBool('ff2???', false);
//assertBool('fdsf1???9', true);
//assertBool('1???9125tgdc', false);
//assertBool('asd5???5asdasdf',  true);
//assertBool('???5jngnc',  false);
//assertBool('112???9', false);
//assertBool('112???9???11', false);
//assertBool('1ff42???9???1', true);
//assertBool('123ffff5???5fff', true);
//assertBool('asd10???0???8f', true);