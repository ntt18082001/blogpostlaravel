<x-client.client-layout title="Blogger">
    <x-slot name="header">
        @vite('resources/css/app.css')
    </x-slot>
    <div id="app"></div>
    <x-slot name="script">
        @vite('resources/js/app.js')
    </x-slot>
</x-client.client-layout>
