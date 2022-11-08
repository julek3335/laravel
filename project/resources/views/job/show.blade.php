@extends('adminlte::page')

@section('title', 'Trasa') 

@section('content_header')
    <h1>Trasa</h1>
@stop

@section('content')
    <x-adminlte-card title="Trasa" theme="lightblue" theme-mode="outline" collapsible maximizable>
        <div class="row">
            <div class="col-sm-12">
                @include('partials.job.end')
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12">
                @include('partials.job.show')
            </div>
        </div>
    </x-adminlte-card>

    @section('plugins.Leaflet', true)
    @section('plugins.Leaflet-GPX', true)
@if($job->status->value == 'in_progress')
    @section('plugins.Leaflet-Control-Geocoder', true)
@endif
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
        var marker = L.marker([52.41567, 16.93088]).addTo(map);
        marker.bindPopup("<center><strong>Pojazd pierwszy</strong><br>Jan Kowalski</center>").openPopup();
    
    @if($job->status->value == 'in_progress')

        L.Control.geocoder().addTo(map);
        
        if (!navigator.geolocation) {
            console.log("Your browser doesn't support geolocation feature!")
        } else {
            navigator.geolocation.getCurrentPosition(getPosition)
            setInterval(() => {
                navigator.geolocation.getCurrentPosition(getPosition)
            }, 2000);
        };
        var marker, circle, lat, long, accuracy;

        let cordsForRequest = [];

        function getPosition(position) {
            //console.log(position);
            lat = position.coords.latitude
            long = position.coords.longitude
            accuracy = position.coords.accuracy
            
            if(cordsForRequest.length)
            {
                let last_cords = cordsForRequest.at(-1);

                if(last_cords.lat != lat || last_cords.long != long)
                {
                    cordsForRequest.push({
                        'lat': lat,
                        'long': long
                    });
                }
            }else{
                cordsForRequest.push({
                    'lat': lat,
                    'long': long
                });
            }
            

            if (marker) {
                map.removeLayer(marker)
            }

            if (circle) {
                map.removeLayer(circle)
            }

            marker = L.marker([lat, long])
            circle = L.circle([lat, long], { radius: accuracy })

            var featureGroup = L.featureGroup([marker, circle]).addTo(map)

            map.fitBounds(featureGroup.getBounds())
        }
    @elseif($job->status->value == 'finished')
        var gpxURL = 'http://localhost:8000/temp-gpx/trasa-min.gpx';
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
    @endif
    </script>
@stop