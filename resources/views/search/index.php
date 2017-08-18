<div id="search">
    <div class="container">
        <div class="row">
            <div class="col-sm-8">
                <form action="search">
                    <search name="query" value="<?=$query?>"></search>
                </form>

                <h3>Resultados</h3>

                <ol>
                    <?php foreach($results as $r):?>
                    <li>
                        <h4><?=isset($r->highlight['title']) ? $r->highlight['title'][0] : $r->title?></h4>
                        <p><?=isset($r->highlight['objective']) ? $r->highlight['objective'][0] : strip_tags($r->objective)?></p>
                    </li>
                    <?php endforeach ?>
                </ol>
            </div>
        </div>
    </div>
</div>
