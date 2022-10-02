@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Pojazd Ford Custom</h1>
@stop

@section('content')
    <x-adminlte-alert theme="warning" title="Przegląd olejowy" dismissable>
        Zbliża się inerwał serwisu olejowego. Do <strong>17.09.2022 r.</strong> należy wykonać serwis.
    </x-adminlte-alert>
    <x-adminlte-card title="Szybki skrót" theme="lightblue" theme-mode="outline" collapsible maximizable>   
        <div class="row">
            <div class="col-sm-4">
                <x-adminlte-info-box title="Przebieg" text="125 458 km" icon="fas fa-light fa-car"/>
            </div>
            <div class="col-sm-4">
                <x-adminlte-info-box title="Przegląd olejowy" text="14500/15000 km" icon="fas fa-regular fa-oil-can"
                    progress=96 progress-theme="dark" description="Pozostało: 500 km, 28 dni."/>
            </div>
        </div>
        
    </x-adminlte-card>

    <x-adminlte-card title="Informacje o pojeździe" theme="lightblue" theme-mode="outline" collapsible maximizable>
        <div class="row">
            <x-adminlte-input name="iLabel" label="Marka" placeholder="Ford"
                fgroup-class="col-md-6" value="Ford" disable-feedback/>
            <x-adminlte-input name="iLabel" label="Model" placeholder="Custom"
                fgroup-class="col-md-6" value="Custom" disable-feedback/>
        </div>   
    </x-adminlte-card>
    <x-adminlte-card title="Historia" theme="lightblue" theme-mode="outline" collapsible="collapsed" maximizable>   
        <div class="timeline">
            <div class="time-label">
                <span class="bg-red">10 Feb. 2014</span>
            </div>

            <div>
                <i class="fas fa-envelope bg-blue"></i>
                <div class="timeline-item">
                    <span class="time"><i class="fas fa-clock"></i> 12:05</span>
                    <h3 class="timeline-header"><a href="#">Support Team</a> sent you an email</h3>
                    <div class="timeline-body">
                        Etsy doostang zoodles disqus groupon greplin oooj voxy zoodles, weebly ning heekya handango imeem plugg dopplr jibjab, movity jajah plickers sifteo edmodo ifttt zimbra. Babblely odeo kaboodle quora plaxo
                        ideeli hulu weebly balihoo...
                    </div>
                    <div class="timeline-footer">
                        <a class="btn btn-primary btn-sm">Read more</a>
                        <a class="btn btn-danger btn-sm">Delete</a>
                    </div>
                </div>
            </div>

            <div>
                <i class="fas fa-user bg-green"></i>
                <div class="timeline-item">
                    <span class="time"><i class="fas fa-clock"></i> 5 mins ago</span>
                    <h3 class="timeline-header no-border"><a href="#">Sarah Young</a> accepted your friend request</h3>
                </div>
            </div>

            <div>
                <i class="fas fa-comments bg-yellow"></i>
                <div class="timeline-item">
                    <span class="time"><i class="fas fa-clock"></i> 27 mins ago</span>
                    <h3 class="timeline-header"><a href="#">Jay White</a> commented on your post</h3>
                    <div class="timeline-body">
                        Take me to your leader! Switzerland is small and neutral! We are more like Germany, ambitious and misunderstood!
                    </div>
                    <div class="timeline-footer">
                        <a class="btn btn-warning btn-sm">View comment</a>
                    </div>
                </div>
            </div>

            <div class="time-label">
                <span class="bg-green">3 Jan. 2014</span>
            </div>

            <div>
                <i class="fa fa-camera bg-purple"></i>
                <div class="timeline-item">
                    <span class="time"><i class="fas fa-clock"></i> 2 days ago</span>
                    <h3 class="timeline-header"><a href="#">Mina Lee</a> uploaded new photos</h3>
                    <div class="timeline-body">
                        <img src="https://placehold.it/150x100" alt="..." />
                        <img src="https://placehold.it/150x100" alt="..." />
                        <img src="https://placehold.it/150x100" alt="..." />
                        <img src="https://placehold.it/150x100" alt="..." />
                        <img src="https://placehold.it/150x100" alt="..." />
                    </div>
                </div>
            </div>

            <div>
                <i class="fas fa-video bg-maroon"></i>
                <div class="timeline-item">
                    <span class="time"><i class="fas fa-clock"></i> 5 days ago</span>
                    <h3 class="timeline-header"><a href="#">Mr. Doe</a> shared a video</h3>
                    <div class="timeline-body">
                        <div class="embed-responsive embed-responsive-16by9">
                            <iframe class="embed-responsive-item" src="https://www.youtube.com/embed/tMWkeBIohBs" allowfullscreen></iframe>
                        </div>
                    </div>
                    <div class="timeline-footer">
                        <a href="#" class="btn btn-sm bg-maroon">See comments</a>
                    </div>
                </div>
            </div>

            <div>
                <i class="fas fa-clock bg-gray"></i>
            </div>
        </div><!-- .timeline -->
    </x-adminlte-card>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop