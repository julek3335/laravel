@extends('adminlte::page')

@section('title', 'Trasa') 

@section('content_header')
    <h1>Trasa</h1>
    <meta name="csrf-token" content="{{ csrf_token() }}">
@stop

@section('content')
    <x-adminlte-card title="Trasa" theme="lightblue" theme-mode="outline" collapsible maximizable>
    @if($job->status->value != 'finished')
        <div class="row">
            <div class="col-sm-12">
                @include('partials.job.end')
            </div>
        </div>
    @endif
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
        /*
        var marker = L.marker([52.41567, 16.93088]).addTo(map);
        marker.bindPopup("<center><strong>Pojazd pierwszy</strong><br>Jan Kowalski</center>").openPopup();
        */

        function drawMap(){
            let gpxURL= '{{$job->route_file}}';
            if(gpxURL){
                let gpx = new L.GPX(gpxURL, {
                    async: true,
                    marker_options: {
                        startIconUrl: '/vendor/leaflet-gpx/img/pin-icon-start.png',
                        endIconUrl: '/vendor/leaflet-gpx/img/pin-icon-end.png',
                        shadowUrl: '/vendor/leaflet-gpx/img/pin-shadow.png'
                    },
                }).on('loaded', function(e) {
                    map.fitBounds(e.target.getBounds());
                }).addTo(map);
            }
        }
    
    @if($job->status->value == 'in_progress')

        L.Control.geocoder().addTo(map);
        
        if (!navigator.geolocation) {
            console.log("Your browser doesn't support geolocation feature!")
        } else {
            navigator.geolocation.getCurrentPosition(getPosition)
            setInterval(() => {
                navigator.geolocation.getCurrentPosition(getPosition)
            }, 5000);

            setInterval(() => {
                if(cordsForRequest.length > 10)
                    saveCordsToDB();   
            }, 15000);

        };

        drawMap();

        //On end job click button save existing cords to DB
        $('.modalEndJobButton').click(function(){
            saveCordsToDB();
        });

        var marker, circle, lat, long, accuracy;

        let cordsForRequest = [];

        let last_cords; 

        let IsMapDrowedFlag = false;
        
        function getPosition(position) {
            lat = position.coords.latitude
            long = position.coords.longitude
            accuracy = position.coords.accuracy
            timestamp = position.coords.timestamp

            if(cordsForRequest.length > 0 )
            {

                if(last_cords.latitude != lat || last_cords.longitude != long)
                {
                    cordsForRequest.push({
                        'elevation': null,
                        'time': new Date(),
                        'latitude': lat,
                        'longitude': long
                    });

                    last_cords = cordsForRequest.at(-1);
                }
            }else if(last_cords == undefined){ //First cords on begining

                cordsForRequest.push({
                    'elevation': null,
                    'time': new Date(),
                    'latitude': lat,
                    'longitude': long
                });

                last_cords = cordsForRequest.at();
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

        function saveCordsToDB(){
            //Send save request to db and render map
            $(document).ready(function() {
                
                last_cords = cordsForRequest.at(-1);

                $.ajax({
                    url: '/route/{{$job->id}}',
                    dataType: "json",
                    method: 'POST',
                    data: { 
                        "gpx_data": cordsForRequest
                    },
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(gpxURL) {

                        cordsForRequest = [];
                        //Draw line
                        if(!IsMapDrowedFlag){
                            drawMap();
                            IsMapDrowedFlag = true;
                        }
                        
                    },
                    error:function (xhr, ajaxOptions, thrownError){
                        if(xhr.status != 200){
                            alert('Błąd, status: ' + xhr.status);
                            console.log(xhr.statusText);
                            console.log(xhr.responseText);
                        }
                    }
                });

                cordsForRequest = [];
            });
        }

    @elseif($job->status->value == 'finished')

        let routeFileName = '{{$job->route_file}}'; 
        if(routeFileName){
            drawMap();
        }
        
    @endif

    </script>
@stop