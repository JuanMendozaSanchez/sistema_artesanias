
@extends('plantilla.dashboard')

@section('title', 'La Oaxaqueña')

@section('contenido')

		<div class="row">
      <div class="col-sm-10 col-md-offset-1">
        <div class="content">
            <div class="container-fluid">
                <div class="card card-map">
          <div class="header">
                        <h4 class="title">Google Maps</h4>
                    </div>
          <div class="map">
            <div id="map"></div>
          </div>
        </div>
      </div>
    </div>
      </div>
    </div>
    
<!--  Google Maps Plugin    
    <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js"></script>-->

    <script>
      function initMap() {
        var oaxaca = {lat: 17.065049, lng: -96.717731};
        var map = new google.maps.Map(document.getElementById('map'), {
          zoom: 18,
          center: oaxaca
        });
        var marker = new google.maps.Marker({
          position: oaxaca,
          map: map
        });
      }
    </script>
    <script async defer
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCWHqNudm8PKemxnf00olB2CRDZjB04Txs&callback=initMap">
    </script>
@endsection

