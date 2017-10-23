<div id="cha-heading">
    <div class="container">
        <ul class="text-right">
            <li>
                <a href="?skin=default" class="cha-btn <?=Session::get('skin') == null ? 'active' : ''?>">ChileAtiende</a>
            </li>
            <li>
                <a href="?skin=mujer" class="cha-btn <?=Session::get('skin') == 'mujer' ? 'active' : ''?>">ChileAtiende Mujer</a>
            </li>
            <li>
                <a href="?skin=exterior" class="cha-btn <?=Session::get('skin') == 'exterior' ? 'active' : ''?>">ChileAtiende en el Exterior</a>
            </li>
        </ul>
    </div>
</div>