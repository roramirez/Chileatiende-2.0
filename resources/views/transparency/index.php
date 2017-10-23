<div id="urls-transparencia">
    <div class="container">

        <ol class="breadcrumb">
            <li><a href=""><i class="material-icons">home</i></a></li>
            <li class="active">Enlaces para Transparencia activa</li>
        </ol>

        <h3>Enlaces para Transparencia activa</h3>
        <hr />

        <transparency-list :data="<?= e(json_encode($list)) ?>" base-url="<?=Request::url()?>"></transparency-list>
    </div>
</div>