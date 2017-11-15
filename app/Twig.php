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
        $caca = preg_replace('/{{.*(}}|$)/sU','', $string);
        return $caca;
    }

    public static function convertPMLToHTML($string){
        $string = preg_replace('/{{mensaje\[(.+)\]:(.+)}}/sU', "<div class='message message-$1'>$2</div>" ,$string);

        $string = preg_replace('/{{youtube:(.*)}}/sU', '<div class="embed-responsive embed-responsive-16by9"><iframe class="embed-responsive-item" src="https://www.youtube.com/embed/$1"></iframe></div>' ,$string);

        $string = preg_replace('/{{doc\[(.+)\]:(.+)}}/sU', "<div class='doc doc-$1'>$2</div>" ,$string);

        $count = preg_match_all('/{{paso:(.+)}}.*{{contenido:(.+)}}/sU', $string, $matches);
        if ($count){
            $string = preg_replace('/{{paso:.+}}/sU','',$string);
            $string = preg_replace('/{{contenido:.+}}/sU','',$string);
            $string .= "<steps :terms='".json_encode($matches[1])."' :definitions='".json_encode($matches[2])."'></steps>";
        }

        return $string;
    }

    public static function convertPMLToTwig($string){
        $twig = preg_replace('/\[\[(\d+)\]\]/sU', "{{page_url($1)}}" ,$string);

        return $twig;
    }
}