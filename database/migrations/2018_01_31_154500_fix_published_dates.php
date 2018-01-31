<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class FixPublishedDates extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $pages = DB::table('pages')->select('id','master_id','published_at')->where('master',0)->get();
        foreach($pages as $p){
            DB::table('pages')->where('id', $p->master_id)->update(['published_at' => $p->published_at]);
        }

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::table('pages')->where('master', 1)->update(['published_at', null]);
    }
}
