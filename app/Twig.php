<?php

namespace App;


class Twig{

    public static function render($string, $data = []){
        try{
            $response = \Twig::createTemplate($string)->render($data);
        }catch(\Exception $e){
            return '<p>'.$e->getMessage().'</p>';
        }

        return $response;
    }
}