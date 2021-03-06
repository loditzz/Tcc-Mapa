 <div id="page-wrapper">
  <div id="firstComponent">
  </div>
  <div id="secondComponent">
  </div>
  <div id="thirdComponent">
  </div>
  <div class="row">
    <div class="col-lg-12">
      <h1 class="page-header"><?php echo 'Administrar '.$subtitulo ?></h1>
    </div>
    <!-- /.col-lg-12 -->
  </div>
  <!-- /.row -->
  <div class="row">

    <div class="col-lg-12">
      <div class="panel panel-default">
        <div class="panel-heading">
         <?php echo 'Alterar Categoria '.$subtitulo ?>
       </div>
       <div class="panel-body">
        <div class="row">
          <div class="col-lg-12">
            <div>
              <input id="zoom-to-area-text" type="text" placeholder="Digite o novo endereço">
              <input id="zoom-to-area" type="button" value="Buscar">
            </div>
            <div id="map"></div>
            <?php
            echo validation_errors('<div class="alert alert-danger">', '</div>');
                            //abertura do formulário
                            //informo o controlador e o metodo que vai acessar o form
            echo form_open('conta/ocorrencia/salvar_alteracoes');
            foreach ($ocorrencias as $ocorrencia) {

              ?>
              <div class="form-group">
                <label id="nomelabel">Nome</label>
                <input type ="text" id="nome" name ="nome" class="form-control" placeholder="Digite o nome da ocorrencia" value="<?php echo $ocorrencia->name ?>">
              </div>
              <div class="form-group">
                <input type="hidden" name="id" id="id" class="form-control" placeholder="id" value="<?php echo $ocorrencia->id ?>">
              </div>
              <div class="form-group">
                <label id="addresslabel">Endereço</label>
                <input type="text" name="address" id="address" class="form-control" placeholder="Endereço" value="<?php echo $ocorrencia->address ?>">
              </div>
              <div class="form-group">
                <input type="hidden" name="lat" id="lat" class="form-control" placeholder="lat" value="<?php echo $ocorrencia->lat ?>">
              </div>
              <div class="form-group">
                <input type="hidden" name="lng" id="lng" class="form-control" placeholder="lng" value="<?php echo $ocorrencia->lng ?>">
              </div>
              <div class="form-group">
                            <label id="txt-descricao">Descricao</label>
                            <textarea id="txt-descricao" name ="txt-descricao" class="form-control"><?php echo $ocorrencia->descricao?></textarea>
                </div> 
              <!--
              <div class="form-group">
                <label id="typelabel">Type</label>
                <input type="text" name="type" id="type" class="form-control" placeholder="type" value="<?php echo $ocorrencia->type ?>">
              </div> -->

              <button type="submit" class="btn btn-default">Atualizar</button>
              <?php
            }
            echo form_close();
            ?>
          </div>

        </div>
        <!-- /.row (nested) -->
      </div>
      <!-- /.panel-body -->
    </div>
    <!-- /.panel -->
  </div>


</div>
<!-- /.row -->


</div>
<!-- /#page-wrapper -->
</div>

<script>
  function initMap() {
  //variavel que irá guardar uma posição: latitude e longitude
  var uluru = {
    //lat: document.getElementById('lng').value
    //lng: document.getElementById('lat').value
    lat: <?php echo $ocorrencia->lat ?>,
    lng: <?php echo $ocorrencia->lng ?>
  };

  //construtor que cria um novo mapa - center e zoom required

  var map = new google.maps.Map(document.getElementById('map'), {
    zoom: 6,
    center: uluru
  });

// This autocomplete is for use in the geocoder entry box.
var zoomAutocomplete = new google.maps.places.Autocomplete(
  document.getElementById('zoom-to-area-text'));
  //variavel que irá criar uma nova instancia de um marcador (marker)
  var marker = new google.maps.Marker({
    position: uluru,
    map: map
  });

  document.getElementById('zoom-to-area').addEventListener('click', function() {
    zoomToArea();
  });

  function zoomToArea() {
    // Initialize the geocoder.
    var geocoder = new google.maps.Geocoder();
    // Get the address or place that the user entered.
    var address = document.getElementById('zoom-to-area-text').value;
    // Make sure the address isn't blank.
    if (address == '') {
      window.alert('O endereço não pode ficar em branco');
    } else {
      // Geocode the address/area entered to get the center. Then, center the map
      // on it and zoom in
      geocoder.geocode({
        address: address,
        componentRestrictions: {
          locality: 'Brazil'
        }
      }, function(results, status) {
        if (status == google.maps.GeocoderStatus.OK) {
          map.setCenter(results[0].geometry.location);
          map.setZoom(16);
          marker.setPosition(results[0].geometry.location);

           //mostra o id do endereço
           document.getElementById('firstComponent').innerHTML = "O id do endereço é: " + results[0].place_id ;
          //mostra a lat do endereço
          document.getElementById('lat').value = results[0].geometry.location.lat();
          //mostra a long do endereço
          document.getElementById('lng').value = results[0].geometry.location.lng();
          //preenche automaticamente o campo endereço
          document.getElementById('address').value = results[0].formatted_address;
          //mostra o endereço formatado
          document.getElementById('thirdComponent').innerHTML = "O endereço formatado é: " + results[0].formatted_address ;
        } else {
          window.alert('Não foi possível encontrar a localização.' +
            ' tente novamente');
        }
      });
    }
  }
}



</script>
<script async defer
src="https://maps.googleapis.com/maps/api/js?libraries=places&key=AIzaSyBBJFxazuJ8Ky8YlyJ5geM-q6A9TnNFHZ8&callback=initMap">
</script>
</body>
</html>