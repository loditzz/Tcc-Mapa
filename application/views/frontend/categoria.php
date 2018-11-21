<!-- Page Content -->
<div class="container">

  <div class="row">

    <!-- Blog Entries Column -->
    <div class="col-md-8">

      <h1 class="page-header">
        <?php echo $titulo ?> 
        <small> 

          <?php
          if($subtitulo!=''){
            echo $subtitulo;
          }else{
            foreach ($subtitulodb as $dbtitulo) {
             echo $dbtitulo->nome;
           }
         }
         ?> </small>
       </h1>
       <h4><?php foreach($subtitulodb as $dbtitulo){echo $dbtitulo->descricao;} ?></h4>    
       <h2>
       </h2>
       <p class="lead">
       </p>
       <p></p>
       <hr>
     </div>