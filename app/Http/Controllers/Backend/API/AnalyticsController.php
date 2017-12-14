<?php
namespace App\Http\Controllers\Backend\API;
use App\Http\Controllers\Controller;
use Google_Client;
use Google_Service_Analytics;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class AnalyticsController extends Controller{

    public function getRealtime(Request $request){

        $key = md5(serialize([
            'endpoint' => 'analytics/realtime',
            'input' => request()->all()
        ]));

        if (!Cache::has($key)) {

            $client = new Google_Client();
            $client->setApplicationName("Dashboard");
            $client->setAuthConfig(storage_path('app/keys/ChileAtiende-d24a0324cb62.json'));
            $client->setScopes(['https://www.googleapis.com/auth/analytics.readonly']);
            $analytics = new Google_Service_Analytics($client);


            $results = $analytics->data_realtime->get(
                'ga:54672718',
                'rt:activeUsers',
                ['dimensions' => $request->input('dimensions')]);

            Cache::put($key, $results, 0.5);

        }

        $results = Cache::get($key);


        return ['rows'=>$results->getRows(),'totalsForAllResults'=>$results->getTotalsForAllResults()];

    }

    public function getGA(Request $request){

        $key = md5(serialize([
            'endpoint' => 'analytics/ga',
            'input' => request()->all()
        ]));

        if (!Cache::has($key)) {
            $client = new Google_Client();
            $client->setApplicationName("Dashboard");
            $client->setAuthConfig(storage_path('app/keys/ChileAtiende-d24a0324cb62.json'));
            $client->setScopes(['https://www.googleapis.com/auth/analytics.readonly']);
            $analytics = new Google_Service_Analytics($client);

            $results = $analytics->data_ga->get(
                'ga:54672718',
                $request->input('start'),
                $request->input('end'),
                $request->input('metric'),
                [
                    'dimensions' => $request->input('dimensions'),
                    'filters' => $request->input('filters'),
                    'sort' => $request->input('sort'),
                    'max-results' => $request->input('max-results')
                ]);

            Cache::put($key, $results, 10);
        }

        $results = Cache::get($key);


        return ['rows'=>$results->getRows(),'totalsForAllResults'=>$results->getTotalsForAllResults()];

    }

}