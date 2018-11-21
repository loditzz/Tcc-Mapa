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

        <div class="col-lg-6">
            <div class="panel panel-default">
                <div class="panel-heading">
                   <?php echo 'Adicionar nova '.$subtitulo ?>
               </div>
               <div class="panel-body">
                <div class="row">
                    <div class="col-lg-12">
                        <div>
                          <input id="zoom-to-area-text" type="text" placeholder="Digite o endereço">
                          <input id="zoom-to-area" type="button" value="Buscar">
                      </div>
                      <div id="map"></div>
                      <?php
                      echo validation_errors('<div class="alert alert-danger">', '</div>');
                            //abertura do formulário
                            //informo o controlador e o metodo que vai acessar o form
                      echo form_open('conta/ocorrencia/inserir');
                      ?>
                      <div class="form-group">
                        <label id="nomelabel">Nome</label>
                        <input type ="text" id="nome" name ="nome" class="form-control" placeholder="Digite o nome da ocorrencia">
                    </div>
                    <div class="form-group">
                        <label id="idlabel">Id</label>
                        <input type="text" name="id" id="id" class="form-control" placeholder="id">
                    </div>
                    <div class="form-group">
                        <label id="addresslabel">Endereço</label>
                        <input type="text" name="address" id="address" class="form-control" placeholder="Endereço">
                    </div>
                    <div class="form-group">
                        <label id="latlabel">Lat</label>
                        <input type="text" name="lat" id="lat" class="form-control" placeholder="lat">
                    </div>
                    <div class="form-group">
                        <label id="lnglabel">Lng</label>
                        <input type="text" name="lng" id="lng" class="form-control" placeholder="lng">
                    </div>
                    <div class="form-group">
                        <label id="typelabel">Type</label>
                        <input type="text" name="type" id="type" class="form-control" placeholder="type">
                    </div>

                    <button type="submit" class="btn btn-default">Cadastrar</button>
                    <?php
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
    lat: -22.9068467,
    lng: -43.17289649999998
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
  //variavel que irá criar uma nova instancia de infowindow
  var infowindow = new google.maps.InfoWindow({
    content: 'A janela, ao contrario do marcador, não abre automaticamente' +
      'precisamos adicionar um event listener'
  });

  marker.addListener('click', function() {
    infowindow.open(map, marker)
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