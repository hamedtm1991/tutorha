<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8" />
    <meta name="author" content="Themezhub" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>SkillUp - قالب HTML دوره آنلاین و آموزش</title>

    <!-- Custom CSS -->
    @vite(['resources/css/app.css'])
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
</body>

</html>

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
