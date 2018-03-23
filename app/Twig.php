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

    public static function strip($string){
        $newString = preg_replace('/{{.*:/','', $string);
        $newString = preg_replace('/}}/','', $newString);
        return $newString;
    }

    public static function convertPMLToHTML($string){
        $string = preg_replace('/{{mensaje\[(.+)\]:(.+)}}/sU', "<div class='message message-$1'>$2</div>" ,$string);

        $string = preg_replace('/{{youtube:(.*)}}/sU', '<div class="embed-responsive embed-responsive-16by9"><iframe class="embed-responsive-item" src="https://www.youtube.com/embed/$1"></iframe></div>' ,$string);

        $string = preg_replace('/{{doc\[(.+)\]:(.+)}}/sU', "<div class='doc doc-$1'>$2</div>" ,$string);

        $string = preg_replace('/{{marcolegal:(.+)}}/sU', "<div class='marcolegal'>$1</div>" ,$string);

        $count = preg_match_all('/{{paso:(.+)}}.*{{contenido:(.+)}}/sU', $string, $matches);
        if ($count){
            $replacement = "<steps :terms='".e(json_encode($matches[1]))."' :definitions='".e(json_encode($matches[2]))."'></steps>";
            $replacement = str_replace('$','\$',$replacement);  //Escapamos los caracteres especiales de preg_replace
            $string = preg_replace('/{{paso:(.+)}}.*{{contenido:(.+)}}/s', $replacement, $string);
        }

        return $string;
    }

    public static function convertPMLToTwig($string){
        $twig = preg_replace('/\[\[(\d+)\]\]/sU', "{{page_url($1)}}" ,$string);

        return $twig;
    }
}