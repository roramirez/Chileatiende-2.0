<div id="cha-heading">
    <div class="container">
        <div class="text-right">
            <a href="?skin=default" class="cha-btn <?=Session::get('skin') == null ? 'active' : ''?>">ChileAtiende</a>
            <a href="?skin=mujer" class="cha-btn <?=Session::get('skin') == 'mujer' ? 'active' : ''?>"><span>ChileAtiende</span> Mujer</a>
            <a href="?skin=exterior" class="cha-btn <?=Session::get('skin') == 'exterior' ? 'active' : ''?>"><span>ChileAtiende</span> En el Exterior</a>
        </div>
    </div>
</div>