@extends('adminlte::page')

@section('title', 'Mapa')

@section('content_header')
<h1>Mapa</h1>
@stop

@section('content')
@section('plugins.Leaflet', true)
<x-adminlte-card title="Mapa" theme="lightblue" theme-mode="outline" collapsible maximizable>
    <div id = "map" style = "height: 700px"></div>
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
</script>
@stop