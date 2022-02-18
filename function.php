<?php

function connect(){
    return new mysqli(HOST, USER, PASS, DB);
}

function validate($msg, $type= 'danger'){
    return "<p class= \" alert alert-{$type}\">{$msg}<button data-dismiss=\"alert\" class=\"close\">&times;</button></p>";

}
function emailcheck($email){
    if(filter_var($email, FILTER_VALIDATE_EMAIL)){
        return true;
    }else{
        return false;
    }
}
function old($key){
    echo $_POST[$key] ?? '';
}
function formclear(){
    return $_POST= "";
}
function photoUpload($file_data, $path ='/'){

    $file_name= $file_data['name'];
    $file_tmp_name= $file_data['tmp_name'];
    move_uploaded_file($file_tmp_name, $path . $file_name);
    return $file_name;
}
?>
