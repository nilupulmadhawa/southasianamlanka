<?php

require_once './../util/initialize.php';

function echoObjects($value) {
    echo Functions::print_r_value($value);
}

echoObjects("################################################################################################################################");
//echoObjects($_SESSION);
echoObjects("################################################################################################################################");



//$aaa=Functions::check_privilege_by_module_action("Rep3233ort", "ins");
$aaa=Functions::get_privileges_by_module("Report");
echoObjects("hgfhfhg");
echoObjects($aaa);
