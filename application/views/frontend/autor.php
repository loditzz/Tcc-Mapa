<!-- Page Content -->
<div class="container">

  <div class="row">

    <!-- Blog Entries Column -->
    <div class="col-md-8">

      <h1 class="page-header">
        <?php echo $titulo ?> >
        <small> 

          <?php
          if($subtitulo!=''){
            echo $subtitulo;
          }else{
            foreach ($subtitulodb as $dbtitulo) {
             echo $dbtitulo->titulo;
           }
         }
         ?> </small>
       </h1>
       <h3>Inicio</h3>
       <h4>Veja ocorrencias por local. Digite um endereço para começar (Estado, Cidade, Bairro, Rua, Estabelecimento, etc)</h4>
       <div>
        <input id="zoom-to-area-text" type="text" placeholder="Digite o endereço">
        <input id="zoom-to-area" type="button" value="Buscar">
      </div>
      <br>
      <div id="firstComponent">
      </div>
      <div id="secondComponent">
      </div>
      <div id="thirdComponent">
      </div>

      <div id="map"></div>
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
        lat: -22.9068467,
        lng: -43.17289649999998
      };

      //construtor que cria um novo mapa - center e zoom required
      var map = new google.maps.Map(document.getElementById('map'), {
        zoom: 8,
        center: uluru
      });
      var infoWindow = new google.maps.InfoWindow;

      // Change this depending on the name of your PHP or XML file
      //var url = http://localhost/tcc_frame_ci/model/mapa.php
      //downloadUrl(url,

      downloadUrl('http://localhost/tcc_frame_ci/home/sendXML', function(data) {
        var xml = data.responseXML;
        var markers = xml.documentElement.getElementsByTagName('marker');
        Array.prototype.forEach.call(markers, function(markerElem) {
          var id = markerElem.getAttribute('id');
          var name = markerElem.getAttribute('name');
          var address = markerElem.getAttribute('address');
          var type = markerElem.getAttribute('type');
          var point = new google.maps.LatLng(
            parseFloat(markerElem.getAttribute('lat')),
            parseFloat(markerElem.getAttribute('lng')));

        //seta o conteudo da info window com o nome do local
        //adiciona um DIV à variavel que seta o conteudo da info window
        var infowincontent = document.createElement('div');
        //cria um elemento html do tipo strong
        var strong = document.createElement('strong');
        //seta o conteudo do texto da variavel strong
        strong.textContent = name
        //concatena o que já existe na variavel infowincontent com a variavel strong e com um novo elemento <br> criado
        infowincontent.appendChild(strong);
        infowincontent.appendChild(document.createElement('br'));

      //seta o conteudo da info window com o endereço do local
      var text = document.createElement('text');
      text.textContent = address
      infowincontent.appendChild(text);
      infowincontent.appendChild(document.createElement('br'));

        //seta o conteudo da info window com o tipo de local
        var auxtipo = document.createElement('text');
        auxtipo.textContent = type;
        infowincontent.appendChild(auxtipo);
        
        //seta o icone de acordo com o tipo 
        var icon = customLabel[type] || {};
        var marker = new google.maps.Marker({
          map: map,
          position: point,
          icon: icon.icone
        });
        marker.addListener('click', function() {
          infoWindow.setContent(infowincontent);
          infoWindow.open(map, marker);
        });
      });
      });
      
      
    // This autocomplete is for use in the geocoder entry box.
    var zoomAutocomplete = new google.maps.places.Autocomplete(
      document.getElementById('zoom-to-area-text'));


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

           //mostra o id do endereço
           document.getElementById('firstComponent').innerHTML = "O id do endereço é: " + results[0].place_id ;
          //mostra a latlong do endereço
          document.getElementById('secondComponent').innerHTML = "The Location is " + results[0].geometry.location;
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
  function downloadUrl(url, callback) {
    var request = window.ActiveXObject ?
    new ActiveXObject('Microsoft.XMLHTTP') :
    new XMLHttpRequest;

    request.onreadystatechange = function() {
      if (request.readyState == 4) {
        request.onreadystatechange = doNothing;
        callback(request, request.status);
      }
    };

    request.open('GET', url, true);
    request.send(null);
  }
  function doNothing() {}


</script>
<script async defer
src="https://maps.googleapis.com/maps/api/js?libraries=places&key=AIzaSyBBJFxazuJ8Ky8YlyJ5geM-q6A9TnNFHZ8&callback=initMap">
</script>

<?php
      //base_url(controlador a ser chamado + id a ser passado para o controlador + nome para url amigavel)

      //a variavel dados é passada para a view que pode acessar qualquer posição do array
foreach ($autores as $autor) {?>
  <div class="col-md-4">
    <img class="img-responsive img-circle" src="http://placehold.it/200x200" alt="">
  </div>
  <div class="col-md-8 ">
    <h2>
     <?php echo $autor->nome?>
   </h2> 
   <hr>
   <p>  <?php echo $autor->historico?></p>
   <hr>
   </div>      
   <?php
 }
 ?>




</div>
