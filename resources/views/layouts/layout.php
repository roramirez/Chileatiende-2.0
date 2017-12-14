<?=view('chunks/head', $__data)?>
<div id="app">
    <header class="default">
        <?= view('chunks/navbar') ?>

        <?php if(@!$hideSearch): ?>
        <div class="search-area hidden-print">
            <div class="container">
                <label>¿Qué trámite o servicio buscas?</label>
                <form action="buscar">
                    <search id="search" name="query" value="<?=@e($query)?>"></search>
                </form>
            </div>
        </div>
        <?php endif ?>
    </header>

    <main>
        <?=$content?>
    </main>

    <?=view('chunks/footer')?>
</div>
<?=view('chunks/foot')?>