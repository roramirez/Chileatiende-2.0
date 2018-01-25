<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddCommentsToPageTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('pages', function($table)
        {
            $table->renameColumn('comentarios', 'comments');
        });

        $pages = DB::table('pages')->select('id','comments')->get();
        foreach($pages as $p){
            $comments = json_decode($p->comments);
            if($comments){
                $comments->title = $comments->titulo ?? '';
                $comments->objective = $comments->objetivo ?? '';
                $comments->details = $comments->cc_observaciones ?? '';
                $comments->beneficiaries = $comments->beneficiarios ?? '';
                $comments->requirements = $comments->doc_requeridos ?? '';
                $comments->online_guide = $comments->guia_online ?? '';
                $comments->online_url = $comments->guia_online_url ?? '';
                $comments->office_guide = $comments->guia_oficina ?? '';
                $comments->phone_guide = $comments->guia_telefonico ?? '';
                $comments->mail_guide = $comments->guia_correo ?? '';
                $comments->legal = $comments->marco_legal ?? '';
                DB::table('pages')->where('id', $p->id)->update(['comments' => json_encode($comments)]);
            }
        }

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('pages', function($table)
        {
            $table->renameColumn('comments', 'comentarios');
        });
    }
}
