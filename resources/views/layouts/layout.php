<?=view('chunks/head', ['title' => $title])?>
<div id="app">
    <header class="default">
        <nav class="navbar navbar-default navbar-static-top">
            <div class="container">
                <!-- Brand and toggle get grouped for better mobile display -->
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                            data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="">
                        <img class="gob" src="images/gob.svg" alt="Gobierno de Chile" />
                        <img src="images/logo.svg" alt="ChileAtiende" />
                    </a>
                </div>

                <!-- Collect the nav links, forms, and other content for toggling -->
                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                    <ul class="nav navbar-nav navbar-right">
                        <li><a href="#">¿Qué es ChileAtiende?</a></li>
                        <li><a href="#">Centro de Ayuda</a></li>
                    </ul>
                </div><!-- /.navbar-collapse -->
            </div><!-- /.container-fluid -->
        </nav>
        <div class="search-area">
            <div class="container">
                <label>¿Qué trámite o servicio buscas?</label>
                <form action="buscar">
                    <search id="search" name="query" value="<?=@$query?>"></search>
                </form>
            </div>
        </div>
    </header>

    <main>
        <?=$content?>
    </main>

    <?=view('chunks/footer')?>
</div>
<?=view('chunks/foot')?>