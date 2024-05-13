<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Admin') }}
        </h2>
    </x-slot>

    <div>
        <div class="mx-auto sm:px-6 lg:px-8">
            <livewire:admin/>
        </div>
    </div>
</x-app-layout>
