<?php

namespace App\Console\Commands;

use App\Page;
use App\SessionVisit;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

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
        $visits = DB::select('SELECT a.page_id AS a, b.page_id AS b, COUNT(*) AS visits
          FROM session_visits AS a
          JOIN session_visits AS b ON b.session_id = a.session_id AND b.page_id > a.page_id
          GROUP BY a.page_id, b.page_id
        ');

        $this->info('Construyendo matriz de co-ocurrencia.');
        $matrix = [];
        foreach($visits as $v){
            $matrix[$v->a][$v->b] = $v->visits;
        }

        $this->info('Almacenamos en base de datos.');
        foreach($matrix as $pageId => $row){
            arsort($row);
            $bestMatches = array_keys(array_slice($row, 0, 3, true));
            $page = Page::find($pageId);
            $page->similarPages()->sync($bestMatches);
        }

        return;
    }


}
