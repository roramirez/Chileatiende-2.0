<?php

namespace App\Console\Commands;

use App\Suggestion;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use Illuminate\Console\Command;

class IndexElasticsearch extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'elasticsearch:index {operation}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Crea los indices en elasticsearch';

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

        $client = new Client();

        $operation = $this->argument('operation');

        if($operation == 'create'){
            try {
                $this->info('Se borra índice');
                $response = $client->request('DELETE', env('ELASTICSEARCH_HOST').'/'.env('ELASTICSEARCH_INDEX'));
            }catch(ClientException $e){
                $this->line($e->getMessage());
            }


            $this->info('Se crea índice');
            $response = $client->request('PUT', env('ELASTICSEARCH_HOST').'/'.env('ELASTICSEARCH_INDEX'), [
                'json' => [
                    'mappings' => [
                        'pages' => [
                            'properties' => [
                                'title' => [
                                    'type' => 'text',
                                    'analyzer' => 'spanish'
                                ],
                                'keywords' => [
                                    'type' => 'text',
                                    'analyzer' => 'spanish'
                                ],
                                'objective' => [
                                    'type' => 'text',
                                    'analyzer' => 'spanish'
                                ],
                                'hit_count' => [
                                    'type' => 'integer'
                                ],
                                'institution_id' => [
                                    'type' => 'keyword'
                                ],
                                'category_id' => [
                                    'type' => 'integer'
                                ]
                            ]
                        ],
                        'suggestions' => [
                            'properties' => [
                                'query' => [
                                    'type' => 'completion'
                                ]
                            ]
                        ]
                    ]
                ]
            ]);
        }elseif ($operation == 'index'){
            $this->call('scout:import', ['model' => 'App\Page']);

            Suggestion::refreshData();
            $this->call('scout:import', ['model' => 'App\Suggestion']);
        }




    }
}
