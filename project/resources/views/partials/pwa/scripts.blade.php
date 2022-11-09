<script>
    //Registering the service worker 
    window.addEventListener("load", () => {
        if ("serviceWorker" in navigator) {
            navigator.serviceWorker.register("/service-worker.js");
        }
    });
</script>
<script src="{{ URL::asset('js/pwa/installation.js') }}"></script>