<div>
    <ol class="breadcrumb">
        <li><a href="backend">Inicio</a></li>
        <li class="active">Perfil</li>
    </ol>

    <profile-form :user='<?=e($user)?>' :edit="<?=$edit ? 'true' : 'false'?>"></profile-form>

</div>