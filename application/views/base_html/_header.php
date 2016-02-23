<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8" />
    <?php
    echo (isset($description) && !empty($description) ? '<meta name="description" content="' . $description . '" />' . PHP_EOL : '');
    echo (isset($keywords) && !empty($keywords) ? '<meta name="keywords" content="' . $keywords . '" />' . PHP_EOL : '');
    echo (isset($robots) && !empty($robots) ? '<meta name="robots" content="' . $robots . '" />' . PHP_EOL : '');
    ?>
    <meta name='dcterms.rightsHolder' content='Thevelopment' />
    <meta name='dcterms.rights' content='© 2013 Thevelopment' />
    <meta name='dcterms.dateCopyrighted' content='2013' />
    <title><?= $titulo ?></title>
    <?php
    if (isset($noscript) && $noscript == TRUE) {
        echo '<noscript>
            <meta http-equiv="Refresh" content="0; URL=erro/javascript">
          </noscript>', PHP_EOL;
    }
    /** ===========================================================
     * Não modifique daqui para cima ----------
     * ============================================================
     */
    ?>
    <link type="image/x-icon" rel="shortcut icon" href="<?= BASEURL ?>favicon.ico">
    <link href='<?= BASEURL ?>resources/css/reset.css' rel='stylesheet' type='text/css' />
    <link href='<?= BASEURL ?>resources/css/style.css' rel='stylesheet' type='text/css' />
    <link href='<?= BASEURL ?>resources/css/animation/myAnimations.css' rel='stylesheet' type='text/css' />
    <script src='<?= BASEURL ?>resources/js/jquery-1.11.0.min.js' type='text/javascript'></script>
    <script src="<?= BASEURL ?>resources/js/smoothscroll.js" type="text/javascript"></script>
    <script src='<?= BASEURL ?>resources/js/bibliotecaAjax.js' type='text/javascript'></script>
    <script src='<?= BASEURL ?>resources/js/SistemaKey.js' type='text/javascript'></script>
    
    <!--[if lte IE 8]>
    <script src="<?= BASEURL ?>resources/js/html5shiv_3.7.0.js" type="text/javascript"></script>
    <![endif]-->
    
</head>
<body>
