<?php


function ns($text = "", $safe = "", $num=false){
    if(!$text || $text == "") return $safe;
    if($num == true && $text == 0) return $safe;
    return $text; 

}

function wa($no, $text=""){
    $ci = & get_instance();

    if(!$no || $no == "" || $no == 0) return ""; 
    else return "https://wa.me/$no?text=$text";
}

function btnWA($no, $text="", $btnp="Whatsapp"){
    if(!$no || $no == "" || $no == 0) return ""; 
    else return '<a href="https://wa.me/'.$no.'?text='.$text.'" class="btn btn-success btn-sm p-2">'.$btnp.'</a>';
}


?>
