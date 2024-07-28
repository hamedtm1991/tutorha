<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    @stack('seo')

    <!-- Custom CSS -->
    @vite(['resources/css/app.css'])
    @vite(['resources/css/videojs.css'])
    @stack('styles')

</head>

<body dir="rtl">
    <x-header/>

    <div id="main-wrapper">
        {{ $slot }}
    </div>

    <x-footer/>

    @stack('scripts')

    @vite(['resources/js/app.js'])
    @vite(['resources/js/bootstrap.js'])
    @vite(['resources/js/metisMenu.js'])
    @vite(['resources/js/custom.js'])
    @vite(['resources/js/videojs.js'])
</body>

</html>
<script type="text/javascript">
    ["keydown","touchmove","touchstart","mouseover"].forEach(function(v){window.addEventListener(v,function(){if(!window.isGoftinoAdded){window.isGoftinoAdded=1;var i="f0pns7",d=document,g=d.createElement("script"),s="https://www.goftino.com/widget/"+i,l=localStorage.getItem("goftino_"+i);g.type="text/javascript",g.async=!0,g.src=l?s+"?o="+l:s;d.getElementsByTagName("head")[0].appendChild(g);}})});
    window.addEventListener('goftino_ready', function () {
        Goftino.setUser({
            email : '',
            name : '',
            about : '',
            phone : '{{ Auth::user()->mobile ?? '' }}',
            avatar : '',
            tags : '',
            forceUpdate : false
        });
    });
</script>

<script>
    var x = '';

    Livewire.on('verificationTimer', () => {

        let seconds = 120;

        window.clearInterval(this.x);


        this.x = setInterval(function() {
            seconds -= 1;
            document.getElementById("demo").innerHTML = seconds ;

            if (seconds < 60) {
                document.getElementById("demo").style.color = "#e6b107";
            }

            if(seconds < 30) {
                document.getElementById("demo").style.color = "red";
            }

            if (seconds < 0) {
                document.getElementById("demo").style.display = "none";
                document.getElementById("resend-verification").style.display = "block";
                clearInterval(x);
            }
        }, 1000);
    })
</script>
