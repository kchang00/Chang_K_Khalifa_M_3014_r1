<?php

function redirect_to($location){
    if($location != null){
        header('Location:' .$location);
        // very important to include exit for security (after header - redirect)
        exit;
    }
}