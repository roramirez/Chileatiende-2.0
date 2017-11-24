<!DOCTYPE html>
<html lang="es">
<head>
    <base href="<?=url('')?>" />
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="<?=csrf_token()?>">
    <link rel="shortcut icon" type="image/x-icon" href="images/favicon.ico"  />
    <title>ChileAtiende - <?=$title?></title>
    <meta property="og:title" content="<?=$title?>" />
    <meta name="twitter:title" content="<?=$title?>">
    <?php if(isset($description)):?>
        <meta name="description" value="<?=$description?>" />
        <meta property="og:description" content="<?=$description?>" />
        <meta name="twitter:description" content="<?=$description?>">
    <?php endif ?>
    <?php if(isset($keywords)):?>
        <meta name="keywords" value="<?=$keywords?>" />
    <?php endif ?>
    <?php if(isset($author)):?>
        <meta name="author" value="<?=$author?>" />
        <meta name="twitter:creator" content="<?=$author?>">
    <?php endif ?>

    <!-- Bootstrap -->
    <link href="css/app.css" rel="stylesheet">

</head>
<body>
