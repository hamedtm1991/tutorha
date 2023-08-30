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

        <section class="gray pt-4">
            <div class="container-fluid">

                <div class="row">
                    <x-admin-sidebar/>

                    <div class="col-lg-9 col-md-9 col-sm-12">
                        {{ $slot }}
                    </div>

                </div>

            </div>
        </section>

    </div>

    <x-footer/>

    @vite(['resources/js/app.js'])
    @vite(['resources/js/bootstrap.js'])
    @vite(['resources/js/app2.js'])
    @vite(['resources/js/metisMenu.js'])
    @vite(['resources/js/custom.js'])

    @stack('scripts')
</body>

</html>
@vite(['resources/js/ckeditor.js'])
