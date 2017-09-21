<?php

namespace App;


class Twig{

    public static function render($string, $data = []){
        return \Twig::createTemplate($string)->render($data);
    }
}