<!-- Page Content -->
<div class="container">

  <div class="row">

    <!-- Blog Entries Column -->
    <div class="col-md-8">

      <h1 class="page-header">
        <?php echo $titulo ?>
        <small> <?php echo $subtitulo ?> </small>
      </h1>
      <h3>Inicio</h3>
      <h4>Veja ocorrências por local. Digite um endereço para começar (Estado, Cidade, Bairro, Rua, Estabelecimento, etc)</h4>
      <div>
        <input id="zoom-to-area-text" type="text" placeholder="Digite o endereço">
        <input id="zoom-to-area" type="button" value="Buscar">
      </div>
      <br>

      <div id="map"></div>
      <script>

    //variavel que irá guardar os icones - alterar o nome da variavel para customIcon e alterar os tipos
    var customLabel = {
      1: { //racismo - verde e branco
        icone: 'https://cdn1.iconfinder.com/data/icons/Map-Markers-Icons-Demo-PNG/32/Map-Marker-Marker-Inside-Chartreuse.png'
      },
      2: { //homofobia - azul e branco
        icone: 'https://cdn1.iconfinder.com/data/icons/Map-Markers-Icons-Demo-PNG/32/Map-Marker-Marker-Inside-Azure.png'
      },
       4: { // rosa e branco
        icone: 'https://cdn1.iconfinder.com/data/icons/Map-Markers-Icons-Demo-PNG/32/Map-Marker-Marker-Inside-Pink.png'
      },
      5: { // verde e preto
        icone: 'https://cdn1.iconfinder.com/data/icons/Map-Markers-Icons-Demo-PNG/32/Map-Marker-Marker-Outside-Chartreuse.png'
      },
      6: { // azul e preto
        icone: 'https://cdn1.iconfinder.com/data/icons/Map-Markers-Icons-Demo-PNG/32/Map-Marker-Marker-Outside-Azure.png'
      },
       7: { // rosa e preto
        icone: 'https://cdn1.iconfinder.com/data/icons/Map-Markers-Icons-Demo-PNG/32/Map-Marker-Marker-Outside-Pink.png'
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
        zoom: 11,
        center: uluru
      });
      var infoWindow = new google.maps.InfoWindow;

      // Change this depending on the name of your PHP or XML file
      downloadUrl('http://localhost/tcc_frame_ci/home/sendXML', function(data) {
        var xml = data.responseXML;
        var markers = xml.documentElement.getElementsByTagName('marker');
        Array.prototype.forEach.call(markers, function(markerElem) {
          var id = markerElem.getAttribute('id');
          var name = markerElem.getAttribute('name');
          var address = markerElem.getAttribute('address');
          var type = markerElem.getAttribute('type');
          var typename = markerElem.getAttribute('typename');
          var descricao = markerElem.getAttribute('descricao');
          var point = new google.maps.LatLng(
            parseFloat(markerElem.getAttribute('lat')),
            parseFloat(markerElem.getAttribute('lng')));


        //seta o conteudo da info window com o nome do local
        //adiciona um DIV à variavel que seta o conteudo da info window
        var infowincontent = document.createElement('div');

        //CRIAÇÃO DO LINK NO TÍTULO DA INFOWINDOW
        //cria o elemento a
        var myLink = document.createElement('a'); 
        //cria o atributo href
        var href = document.createAttribute('href'); 
        //seta o atributo href com o endereço: endereço base + controlador ocorrencia + metodo visializar + codog
        myLink.setAttribute('href','http://localhost/tcc_frame_ci/ocorrencia/'+id); 
        myLink.innerText =name;
      //seta o conteudo da info window com o endereço do local
      infowincontent.appendChild(myLink);


      infowincontent.appendChild(document.createElement('br'));
      infowincontent.appendChild(document.createElement('br'));
       //seta o conteudo da info window com a descrição
       var auxdescricao = document.createElement('text');
       auxdescricao.textContent = descricao;
       infowincontent.appendChild(auxdescricao);
       infowincontent.appendChild(document.createElement('br'));
       infowincontent.appendChild(document.createElement('br'));


       var text = document.createElement('text');
       text.textContent = address
       infowincontent.appendChild(text);
       infowincontent.appendChild(document.createElement('br'));
       infowincontent.appendChild(document.createElement('br'));
        //seta o conteudo da info window com o tipo de local
        var auxtipo = document.createElement('text');
        auxtipo.textContent = typename;
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
            map.setZoom(12);

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
src="https://maps.googleapis.com/maps/api/js?libraries=places&key=AIzaSyBBJFxazuJ8Ky8YlyJ5geM-q6A9TnNFHZ8&language=pt-BR&callback=initMap">
</script>
</div>
