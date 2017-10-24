<?php

namespace App\Console\Commands;

use App\Page;
use App\SessionVisit;
use Illuminate\Console\Command;

class SimilarityML extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'ml:similarity';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Calcula las fichas similares de acuerdo a visitas de las personas';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $this->calculatePageSimilarity();

    }

    private function calculatePageSimilarity(){

        $this->info('Capturando datos de tabla de visitas.');
        $visits = SessionVisit::all();

        $visitsGroupedByPageId = $visits->groupBy('page_id');
        $visitsGroupedBySessionId = $visits->groupBy('session_id');

        $this->info('Construyendo matriz de co-ocurrencia.');
        $matrix = [];
        foreach($visitsGroupedByPageId as $pageId => $pageVisits) {
            foreach($pageVisits as $v){
                $sessionVisits = $visitsGroupedBySessionId[$v->session_id];
                foreach($sessionVisits as $s){
                    if($pageId != $s->page_id){
                        $matrix[$pageId][$s->page_id] = 1 + @$matrix[$pageId][$s->page_id];
                    }
                }
            }
        }

        $this->info('Ordenamos.');
        foreach($matrix as &$row){
            arsort($row);
            $row = array_slice($row, 0, 3, true);
        }

        $this->info('Almacenamos en base de datos.');
        foreach($matrix as $pageId => $row){
            $page = Page::find($pageId);
            if($page)
                $page->similarPages()->sync(array_keys($row));
        }

        return;
    }


}
