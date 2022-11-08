@extends('adminlte::page')

@section('title', 'Mapa')

@section('content_header')
<h1>Mapa</h1>
@stop

@section('content')
@section('plugins.Leaflet', true)
@section('plugins.Leaflet-GPX', true)
<x-adminlte-card title="Mapa" theme="lightblue" theme-mode="outline" collapsible maximizable>
    <div id="map" style="height: 700px"></div>
</x-adminlte-card>
@stop

@section('js')
<script>

    // Creating map options
    var mapOptions = {
        center: [51.948, 19.292],
        zoom: 7
    }

    // Creating a map object
    var map = new L.map('map', mapOptions);
    
    // Creating a Layer object
    var layer = new L.TileLayer('http://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png');
    
    // Adding layer to the map
    map.addLayer(layer);

    //Add attribution
    L.tileLayer("https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png", {
        attribution: '&copy; <a href="https://www.openstreetmap.org/copyright" target="_blank">OpenStreetMap</a>',
        maxZoom: 19,
      }).addTo(map);

    //Add marker;
    //var marker = L.marker([52.41567, 16.93088]).addTo(map);
    //marker.bindPopup("<center><strong>Pojazd pierwszy</strong><br>Jan Kowalski</center>").openPopup();

    //var gpxURL = '{{  url('') }}/temp-gpx/trasa.gpx'; // URL to your GPX file or the GPX itself
    var gpxURL = '{{  url('') }}/temp-gpx/trasa-min.gpx'; // URL to your GPX file or the GPX itself
    new L.GPX(gpxURL, {
        async: true,
        marker_options: {
            startIconUrl: '/vendor/leaflet-gpx/img/pin-icon-start.png',
            endIconUrl: '/vendor/leaflet-gpx/img/pin-icon-end.png',
            shadowUrl: '/vendor/leaflet-gpx/img/pin-shadow.png'
        }
    }).on('loaded', function(e) {
        map.fitBounds(e.target.getBounds());
    }).addTo(map);

</script>
@stop