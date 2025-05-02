<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    @if (env('IS_DEMO'))
        <meta name="keywords"
            content="html dashboard, TALL, Tailwind, Alpine.js, Livewire, personal project, Nimshi Athukorala" />
        <meta name="description"
            content="A personal project with UI components powered by Tailwind, Alpine.js, Laravel, and Livewire" />
        <meta itemprop="name" content="Personal Dashboard by Nimshi Athukorala" />
        <meta itemprop="description"
            content="A personal project with UI components powered by Tailwind, Alpine.js, Laravel, and Livewire" />
    @endif

    <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('assets') }}/img/logo.png" />
    <link rel="icon" type="image/png" href="{{ asset('assets') }}/img/logo.png" />
    <title>Personal Dashboard by Nimshi Athukorala</title>
    <!-- Fonts and icons -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
    <!-- Nucleo Icons -->
    <link href="{{ asset('assets') }}/css/nucleo-icons.css" rel="stylesheet" />
    <link href="{{ asset('assets') }}/css/nucleo-svg.css" rel="stylesheet" />

    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- Popper -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.11.5/umd/popper.min.js"></script>

    <!-- Main Styling -->
    <link href="{{ asset('assets') }}/css/styles.css?v=1.0.3" rel="stylesheet" />

    @vite('resources/css/app.css')

    @livewireStyles
</head>

<body class="m-0 font-sans antialiased font-normal text-size-base leading-default bg-gray-50 text-slate-500">
    {{ $slot }}

    @livewireScripts
</body>

<!-- plugin for charts  -->
<script src="{{ asset('assets') }}/js/plugins/chartjs.min.js" async></script>
<!-- plugin for scrollbar  -->
<script src="{{ asset('assets') }}/js/plugins/perfect-scrollbar.min.js" async></script>
<!-- github button -->
<script async defer src="https://buttons.github.io/buttons.js"></script>
<!-- main script file  -->
<script src="{{ asset('assets') }}/js/soft-ui-dashboard-tailwind.js?v=1.0.3" async></script>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    document.addEventListener('livewire:init', () => {
        Livewire.on('show-success-alert', (event) => {
            const data = event[0] || event;
            Swal.fire({
                icon: data.type || 'success',
                title: data.message,
                toast: true,
                position: 'bottom-end',
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true,
            });
        });

        Livewire.on('confirm-delete', (event) => {
            const data = event[0] || event; // Handle array or object payload
            console.log('confirm-delete event:', data); // Debug the payload
            Swal.fire({
                icon: 'warning',
                title: 'Are you sure?',
                text: data.message,
                showCancelButton: true,
                confirmButtonText: 'Yes, delete it!',
                cancelButtonText: 'Cancel',
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
            }).then((result) => {
                if (result.isConfirmed) {
                    console.log('Dispatching confirmedDelete Id: ' + data);
                    Livewire.dispatch('confirmedDelete', [data]);
                }
            });
        });
    });
</script>

</html>
