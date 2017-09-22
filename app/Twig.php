<?php

namespace App;


class Twig{

    public static function render($string, $data = []){
        $string = self::convertPMLToHTML($string);
        $string = self::convertPMLToTwig($string);

        try{
            $response = \Twig::createTemplate($string)->render($data);
        }catch(\Exception $e){
            return '<p>'.$e->getMessage().'</p>';
        }

        return $response;
    }

    public static function convertPMLToHTML($string){
        $twig = preg_replace('/{{mensaje\[(.+)\]:(.+)}}/', "<div class='mensaje mensaje-$1'>$2</div>" ,$string);

        return $twig;
    }

    public static function convertPMLToTwig($string){
        $twig = preg_replace('/\[\[(\d+)\]\]/', "{{page_url($1)}}" ,$string);

        return $twig;
    }
}