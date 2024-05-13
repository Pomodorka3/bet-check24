<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div>
        <div class="mx-auto sm:px-6 lg:px-8">
            <div class="w-full flex">
                    @foreach(auth()->user()->communities as $community)
                        <div class="w-1/3 m-2">
                                <livewire:sneak-preview :community="$community"/>
                        </div>
                    @endforeach
            </div>
            <livewire:dashboard/>
            <livewire:leaderboard communityId='1'/>
        </div>
    </div>
</x-app-layout>
