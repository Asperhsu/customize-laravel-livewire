<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Customize Livewire</title>
</head>
<body>
    <livewire:styles />
    <livewire:scripts />

    {{-- chnage api prefix url --}}
    <script>window.livewire_app_url = "{{ url(config('backstage-livewire.prefix')) }}";</script>
</body>
</html>