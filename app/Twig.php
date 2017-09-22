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

    public static function convertPMLToTwig($string){
        $twig = preg_replace('/{{mensaje\[(.+)\]:(.+)}}/', "{{mensaje(tipo='$1', texto='$2')}}" ,$string);

        return $twig;
    }
}