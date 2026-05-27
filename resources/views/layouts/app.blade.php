<!DOCTYPE html>
<html>
<head>

    <title>@yield('title')</title>

    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- PWA -->

    <link rel="manifest" href="/manifest.json">

    <meta name="theme-color" content="#111827">

    <!-- IOS SUPPORT -->

    <meta name="apple-mobile-web-app-capable" content="yes">

    <meta name="apple-mobile-web-app-status-bar-style"
          content="black-translucent">

    <meta name="apple-mobile-web-app-title"
          content="Notes App">

    <link rel="apple-touch-icon"
          href="/icons/icon-192.png">

    <!-- BOOTSTRAP -->

    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">

    <!-- GLOBAL STYLES -->

    <style>

        body{
            background:#f5f7fb;
            font-family:Arial, sans-serif;
        }

    </style>

</head>

<body>

    @yield('content')

    <!-- SERVICE WORKER -->

    <script>

        if ('serviceWorker' in navigator) {

            navigator.serviceWorker
                .register('/service-worker.js');

        }

    </script>

    <!-- INSTALL BUTTON -->

    <script>

        let deferredPrompt;

        window.addEventListener('beforeinstallprompt', (e) => {

            e.preventDefault();

            deferredPrompt = e;

            const installBtn =
                document.getElementById('installBtn');

            if(installBtn){

                installBtn.classList.remove('d-none');

            }

        });

        async function installApp(){

            if (!deferredPrompt) return;

            deferredPrompt.prompt();

            const result =
                await deferredPrompt.userChoice;

            if(result.outcome === 'accepted'){

                document
                    .getElementById('installBtn')
                    .classList.add('d-none');

            }

            deferredPrompt = null;

        }

    </script>

</body>
</html>