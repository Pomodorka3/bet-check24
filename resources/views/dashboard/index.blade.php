<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div>
        <div class="mx-auto sm:px-6 lg:px-8">
            <livewire:dashboard/>
            <livewire:leaderboard communityId='1'/>
        </div>
    </div>
</x-app-layout>
