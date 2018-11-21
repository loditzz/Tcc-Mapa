<!-- Page Content -->
<div class="container">

  <div class="row">

    <!-- Blog Entries Column -->
    <div class="col-md-8">



      <?php
      //base_url(controlador a ser chamado + id a ser passado para o controlador + nome para url amigavel)

      //a variavel dados é passada para a view que pode acessar qualquer posição do array
      foreach ($postagem as $destaque) {?>
       <h1>
        <?php echo $destaque->name ?></a>
      </h1>

      <p><span class="glyphicon glyphicon-time"></span><?php echo postadoem($destaque->data_ocorrencia)?></p>
      <hr>
      <p><?php 
      echo $destaque->descricao;
    /*foreach ($tipopre as $tipop){
      echo $tipop->nome;*/
    }

    ?></p>
    <script>

    //variavel que irá guardar os icones - alterar o nome da variavel para customIcon e alterar os tipos
    var customLabel = {
      1: {
        icone: 'https://cdn1.iconfinder.com/data/icons/Map-Markers-Icons-Demo-PNG/32/Map-Marker-Marker-Inside-Chartreuse.png'
      },
      bar: {
        label: 'B'
      }
    };


    function initMap()
    {
      //variavel que irá guardar uma posição: latitude e longitude
      var uluru = {
       lat: <?php echo $destaque->lat ?>,
       lng: <?php echo $destaque->lng ?>
     };

      //construtor que cria um novo mapa - center e zoom required
      var map = new google.maps.Map(document.getElementById('map'), {
        zoom: 11,
        center: uluru
      });
      var infoWindow = new google.maps.InfoWindow;
      var marker = new google.maps.Marker({
        position: uluru,
        map: map
      });
      

    }
    function doNothing() {}


  </script>
  <script async defer
  src="https://maps.googleapis.com/maps/api/js?libraries=places&key=AIzaSyBBJFxazuJ8Ky8YlyJ5geM-q6A9TnNFHZ8&callback=initMap&language=pt-BR">
</script>

<hr>
<div id="map"></div>
<hr>
<p><input type="image" src="https://cdn0.iconfinder.com/data/icons/small-n-flat/24/678111-map-marker-24.png"> <?php echo  $destaque->address?></p>
<hr>
<?php  if (!$this->session->userdata('logado')){  ?>
  <p>Os comentários são anônimos, porém você precisa estar logado para comentar. <a href="<?php echo base_url('conta/login')?>">Faça login</a> ou <a href="<?php echo base_url('conta/usuario/pag_cad')?>"> cadastre-se</a>.</p> 
<?php } else{ echo form_open('ocorrencia/inserir') ?>
<h2>Comentar</h2>
<div class="form-group">
  <label id="txt-nome">Titulo</label>
  <input type ="text" id="titulo" name ="titulo" class="form-control" placeholder="Digite o titulo do comentario" value="<?php echo set_value('titulo')?>">

</div>
<div class="form-group">
  <input type="hidden" name="idocorrencia" id="idocorrencia" class="form-control" value="<?php echo $destaque->id;?>">
</div>
<div class="form-group">
  <label id="txt-comentario">Comentario</label>
  <textarea id="comentario" name ="comentario" class="form-control"><?php echo set_value('comentario')?></textarea>
</div>
<button type="submit" class="btn btn-default">Comentar</button> 


<?php echo form_close(); }?>
<hr>
<h1>Comentários</h1>
<?php foreach ($comentarios as $comentario) {?>
  <hr>
  <h3>
    <?php echo $comentario->titulo; ?>
  </h3>
  <p><span class="glyphicon glyphicon-time"></span><?php echo postadoem($comentario->dataHora)?></p>
  <p> <?php echo $comentario->comentario; ?></p>

<?php }?>
</div>
