<?php

function SaveImage($photo , $folder){
    $file_extension = $photo->getClientOriginalExtension();
    $path = $folder;
    $file_name = time().'.'.$file_extension;
    $photo->move($path ,$file_name);
    return $file_name ;
}
