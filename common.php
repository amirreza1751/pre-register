<?php

function hr($return = false){
    if($return){
        return "<hr>\n";
    } else{
        echo "<hr>\n";
    }
}

function br($return = false){
    if($return){
        return "<br>\n";
    } else{
        echo "<br>\n";
    }
}

function dump($var, $return = false){
    if (is_array($var)){
        $out = print_r($var, true);
    } elseif (is_object($var)){
        $out = var_export($var, true);
    } else {
        $out = $var;
    }

    if ($return){
        return "\n<pre style='direction: ltr'>$out</pre>\n";
    } else{
        echo "\n<pre style='direction: ltr'>$out</pre>\n";
    }
}

function getCurrentDateTime(){
    return date("Y-m-d H:i:s");
}

function encryptPassword($password){
    global $config;
    return md5($password . $config['salt']);
}


function trim_number($num)
{
    $eng = array('0','1','2','3','4','5','6','7','8','9');
    $per = array('۰','۱','۲','۳','۴','۵','۶','۷','۸','۹');
    return str_replace($eng,$per,$num);
}

