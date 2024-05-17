<div wire:poll="refresh" class="mt-4 grid grid-cols-1 gap-4 sm:flex-row w-full flex-col" x-cloak x-data="dashboard">
    <div class="w-full bg-white overflow-hidden shadow-sm rounded-lg">
        <div class="text-white p-2 bg-[#2371c2] flex flex-col">
                <span class="text-sm">Community Sneak Preview</span>
            <h2 class="text-xl font-bold">{{$community->name}}</h2>
        </div>
        <div class="flex flex-col w-full">
            <div class="overflow-x-auto">
                <div class="inline-block min-w-full">
                    <div class="overflow-hidden">
                        <table
                            class="min-w-full text-left text-sm font-light text-surface dark:text-white">
                            <thead
                                class="border-b border-neutral-200 bg-white font-medium dark:border-white/10 dark:bg-body-dark">
                            <tr>
                                <th scope="col" class="px-6 py-2">Rank</th>
                                <th scope="col" class="px-6 py-2">Username</th>
                                <th scope="col" class="px-6 py-2">Points</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($users as $key => $user)
                                <tr class="
                                @if($key !== $users->count() - 1) border-b @endif
                                @if($key === 2 || $key === $users->count() - 2) border-black @endif
                                @if($user->id === auth()->user()->id) bg-blue-200 @else bg-white @endif
                                dark:border-white/10">
                                    <td class="whitespace nowrap px-6 py-2 font-medium">
                                        <span>{{$user->rank}}</span>
                                    </td>
                                    <td class="whitespace nowrap px-6 py-2 font-medium">
                                        <span>{{$user->name}}</span>
                                    </td>
                                    <td class="whitespace nowrap px-6 py-2 font-medium">
                                        <span>{{$user->points}}</span>
                                    </td>
                                </tr>
                            </tbody>
                            @endforeach
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
