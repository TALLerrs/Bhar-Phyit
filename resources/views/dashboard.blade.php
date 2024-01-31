<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Page Title' }}</title>
    
    {!! Tallerrs\BharPhyit\Facades\BharPhyit::css() !!}
    @livewireStyles

    {!! Tallerrs\BharPhyit\Facades\BharPhyit::js() !!}
    @livewireScriptConfig
</head>

<body>
    <div class="w-full mx-auto text-gray-950 dark:text-white relative bg-red-700">
        <x-bhar-phyit-layout::nav />
        <section class="mt-20 relative dark:bg-[#09090B] bg-[#FAFAFA] min-h-screen">
            {{ $slot }}
        </section>
    </div>
</body>

</html>