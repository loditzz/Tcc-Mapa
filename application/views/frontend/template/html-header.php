<!DOCTYPE html>
<html lang="pt-br">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">


    <title> <?php
          if($subtitulo!=''){
            echo $subtitulo;
          }else{
            foreach ($subtitulodb as $dbtitulo) {
                 echo $dbtitulo->name;
            }
          }
          ?> </title>

    <style>
      /* Always set the map height explicitly to define the size of the div
      * element that contains the map. */
      #map {
          height: 400px;
          width: 100%;
      }

      #zoom-to-area-text {
          position: relative;
          width: 70%;
      }

      #zoom-to-area {
          width: 24%;
      }

      padding: 0;
  }
</style>
<!-- Bootstrap Core CSS  - TROCAR FRONTEND POR PAGINA INICIAL/PESQUISA E TROCAR BACKEND POR CADASTRAR-->
<link href="<?php echo base_url('assets/frontend/css/bootstrap.min.css')?>" rel="stylesheet">

<!-- Custom CSS -->
<link href="<?php echo base_url('assets/frontend/css/blog.css')?>" rel="stylesheet">

<!-- Custom Fonts -->
<link href="<?php echo base_url('assets/frontend/css/font-awesome.min.css')?>" rel="stylesheet" type="text/css">

<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>
<body>