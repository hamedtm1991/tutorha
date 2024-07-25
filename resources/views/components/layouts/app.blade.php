<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    @stack('seo')

    <!-- Custom CSS -->
    @vite(['resources/css/app.css'])
    <style>
        .visibledevice {display:none;}
        .visibledesktop {display:block;}

        @media (max-width : 1400px) {
            .visibledevice {display:block;}
            .visibledesktop {display:none;}
        }
    </style>
    @stack('styles')

</head>

<body dir="rtl" style="min-height: 100vh;display: flex;flex-direction: column;justify-content: flex-start;">
    <x-header/>

    <div id="main-wrapper">
        {{ $slot }}
    </div>

    <x-footer/>

    @vite(['resources/js/app.js','resources/js/bootstrap.js','resources/js/metisMenu.js','resources/js/custom.js'])
    @stack('scripts')
</body>

</html>

<script>
    var x = '';
    let code = '';
    let otp = [];

    Livewire.hook('morph.updated', ({ el, component }) => {
        let clearInputs = Livewire.first().get('clearInputs')
        let element = document.getElementById('input1')

        if (clearInputs) {
            let inputs = document.getElementsByClassName('auth-input')
            for(i = 0; i < inputs.length; i++) {
                inputs[i].value = "";
            }
            otp = [];
            Livewire.first().set('clearInputs', false)
            Livewire.first().set('code', '')
            code = ''
        }

        if (element) {
            element.focus()
        }

    })

    Livewire.on('verificationTimer', () => {
        setTimeout(() => {
        function addListener(input, index) {

            input.addEventListener("focus", () => {
                input.select()
            })
            input.addEventListener("keyup", (e) => {
                const key = e.key; // const {key} = event; ES6+
                if (key === "Backspace" || key === "Delete") {
                    const prev = input.previousElementSibling;
                    if (prev) prev.focus();
                }

                const code = parseInt(input.value);
                if (!isNaN(code)) {
                    otp[index] = code
                    if (code >= 0 && code <= 9) {
                        const n = input.nextElementSibling;
                        if (n)
                            n.focus();
                    } else {
                        input.value = "";
                        otp[index] = 0
                    }
                } else {
                    input.value = "";
                }

                if (otp.length >= 6) {
                    Livewire.first().set('code', otp.join(''))
                    document.getElementById('form-verify').click();
                }
            });
        }

        const inputs = ["input1", "input2", "input3", "input4", "input5", "input6"];

        inputs.map((id, i) => {
            const input = document.getElementById(id);
            addListener(input,i);
        });
        },300)


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
