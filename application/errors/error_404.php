<!DOCTYPE html>
<html lang="pt">
    <head>
        <meta charset="UTF-8">
        <title>Erro 404</title>
        <link href="<?php echo BASEURL; ?>resources/css/reset.css" rel="stylesheet" type="text/css" />
        <style type="text/css">
            body { background:url('<?php echo BASEURL; ?>resources/css/images/bg_squares.png') }
            #container { width:100%;  }
            .content   { width:800px; margin:0 auto; padding:20px 0; text-align:center; background:#fff; border-left:2px solid #000; border-right:2px solid #000 }
            
            img { padding:60px 0 }
            p { font-size:18px; padding:10px 0 }
        </style>
    </head>
    <body>
        <div id="container">
            <div class="content">
                <h1><?php echo $heading; ?></h1>
                <img src="<?php echo BASEURL; ?>resources/img/erros/erro404_<?php echo rand(1,3); ?>.jpg" alt="" />
                <?php echo $message; ?>
            </div>
        </div>
    </body>
</html>