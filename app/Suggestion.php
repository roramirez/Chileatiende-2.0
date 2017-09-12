<?php

namespace App;

use GuzzleHttp\Client;
use Laravel\Scout\Searchable;
use Illuminate\Database\Eloquent\Model;

class Suggestion extends Model
{
    use Searchable;


    public function toSearchableArray()
    {
        return [
            'query'=> [
                    'input' => $this->query,
                    'weight' => $this->count
                ]
            ];
    }


    public static function suggest($query){
        $client = new Client();

        $response = $client->request('GET', env('ELASTICSEARCH_HOST').'/'.env('ELASTICSEARCH_INDEX').'/_search', [
            'json' => [
                'suggest' => [
                    'suggestions' => [
                        'prefix' => $query,
                        'completion' => [
                            'field' => 'query'
                        ]
                    ]
                ]
            ]
        ]);

        $json = json_decode($response->getBody()->getContents());

        $list = $json->suggest->suggestions[0]->options;

        return $list;
    }

}