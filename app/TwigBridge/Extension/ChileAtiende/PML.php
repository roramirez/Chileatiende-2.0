<?php

namespace App\TwigBridge\Extension\ChileAtiende;

use App\Page;
use Twig_Extension;
use Twig_SimpleFunction;

class PML extends Twig_Extension
{


    /**
     * {@inheritDoc}
     */
    public function getName()
    {
        return 'TwigBridge_Extension_ChileAtiende_PML';
    }

    /**
     * {@inheritDoc}
     */
    public function getFunctions()
    {

        return [
            new Twig_SimpleFunction('page_url', function($id){
                $page = Page::find($id);
                return 'fichas/'.$page->guid;
            })
            //new Twig_SimpleFunction('mensaje', function(array $args = array()){
            //    return '<div class="mensaje mensaje-'.$args['tipo'].'">'.$args['texto'].'</div>';
            //},['is_variadic'=>true,'is_safe' => ['html']])
        ];

    }


}
