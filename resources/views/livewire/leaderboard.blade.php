<div wire:poll.3000ms="refresh" class="mt-4 grid grid-cols-1 gap-4 sm:flex-row w-full flex-col" x-cloak
     x-data="leaderboard">

    <div class="w-full p-6 bg-white overflow-hidden shadow-sm rounded-lg">
        <div class="flex justify-between">
            <h2 class="text-xl my-auto">Leaderboard</h2>
            {{--            <p>Limit: {{$this->limit1}}</p>--}}
            {{--            <p>Offset: {{$this->offset2}}</p>--}}
            {{--            <p>{{$this->currentUserOrder}}</p>--}}
            {{--            <p>{{$this->currentUserOrder - $this->offset2 + 1}}</p>--}}
            <div class="flex">
                <input wire:model="usernameToSearch" type="text" id="usernameToSearch" name="usernameToSearch"
                       @keydown.enter="$wire.searchUser()"
                       class="w-50 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                       placeholder="Search user"/>
                <button wire:click="searchUser()"
                        class="ml-2 p-2 text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                    <svg title="Search" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                         stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round"
                              d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z"/>
                    </svg>
                </button>
            </div>
        </div>
        <div class="flex flex-col w-full">
            <div class="overflow-x-auto">
                <div class="inline-block min-w-full py-2">
                    <div class="overflow-hidden">
                        @if($users->count() > 0)
                            <table
                                class="min-w-full text-left text-sm font-light text-surface dark:text-white">
                                <thead
                                    class="border-b border-neutral-200 bg-white font-medium dark:border-white/10 dark:bg-body-dark">
                                <tr>
                                    <th scope="col"></th>
                                    <th scope="col">Position</th>
                                    <th scope="col" class="px-6 py-2">Username</th>
                                    <th scope="col" class="px-6 py-2">Points</th>
                                    @foreach($matches as $match)
                                        <th scope="col" class="px-1">
                                            <div class="flex w-20 justify-center">
                                                <img class="w-6 h-6"
                                                     src="{{Vite::asset('resources/images/flags/'.$match->team1->countrycode.'.svg')}}"
                                                     alt="{{$match->team1->countrycode}}">
                                                <span class="my-auto mx-1">:</span>
                                                <img class="w-6 h-6"
                                                     src="{{Vite::asset('resources/images/flags/'.$match->team2->countrycode.'.svg')}}"
                                                     alt="{{$match->team2->countrycode}}">
                                            </div>
                                        </th>
                                    @endforeach
                                    {{--                                <th scope="col" class="px-6 py-2 text-center"></th>--}}
                                </tr>
                                </thead>
                                <tbody>

                                @foreach($users1 as $user)
                                    <tr class="border-b border-neutral-200 @if($user->id === auth()->user()->id) bg-black/[0.1] @else bg-black/[0.02] @endif dark:border-white/10">
                                        <td class="whitespace-nowrap p-2">
                                            <button wire:click="pinUser({{$user->id}})" title="Pin user" type="button"
                                                    class="p-1 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 transition-all hover:bg-blue-600 hover:text-white focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                     stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                          d="M15 10.5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z"/>
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                          d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1 1 15 0Z"/>
                                                </svg>
                                            </button>
                                        </td>
                                        <td class="whitespace-nowrap px-6 py-2 font-medium">
                                            {{$user->rank}}
                                        </td>
                                        <td class="whitespace-nowrap px-6 py-2 font-medium">
                                            {{$user->name}}
                                        </td>
                                        <td class="whitespace-nowrap px-6 py-2 font-medium">
                                            {{$user->points}}
                                        </td>
                                        @foreach($matches as $match)

                                                <td class="whitespace-nowrap px-1 @if(!$user->bets->where('match_id', $match->id)->count()) bg-gray-100/[0.8] @endif">
                                                    <div class="flex justify-center">
                                                        <div class="">
                                                            @if($user->bets->where('match_id', $match->id)->count() > 0)
                                                                <div class="flex flex-col">
                                                                    @if($match->starts_at <= now() && !$match->evaluated)
                                                                        <div class="flex">
                                                                            <div class="my-auto relative flex h-2 w-2">
                                                                                <span
                                                                                    class="animate-ping absolute inline-flex h-full w-full rounded-full bg-green-400 opacity-75"></span>
                                                                                <span
                                                                                    class="relative inline-flex rounded-full h-2 w-2 bg-green-500"></span>
                                                                            </div>
                                                                            <span class="ml-2"
                                                                                  title="Current score">({{$match->team_1_score}} : {{$match->team_2_score}})</span>
                                                                        </div>
                                                                    @endif
                                                                        <span class="text-center">{{$user->bets->where('match_id', $match->id)->first()->team_1_score}} : {{$user->bets->where('match_id', $match->id)->first()->team_2_score}}</span>
                                                                </div>
                                                            @else
                                                                <div class="flex flex-col">
                                                                    @if($match->starts_at <= now() && !$match->evaluated)
                                                                    <div class="flex">
                                                                        <div class="my-auto relative flex h-2 w-2">
                                                                            <span
                                                                                class="animate-ping absolute inline-flex h-full w-full rounded-full bg-green-400 opacity-75"></span>
                                                                            <span
                                                                                class="relative inline-flex rounded-full h-2 w-2 bg-green-500"></span>
                                                                        </div>
                                                                        <span class="ml-2"
                                                                              title="Current score">({{$match->team_1_score}} : {{$match->team_2_score}})</span>
                                                                    </div>
                                                                    @endif
                                                                        <span class="text-center text-gray-400" title="Player's bet">- : -</span>
                                                                </div>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </td>
                                        @endforeach
                                    </tr>
                                @endforeach
                                @if($users1Expandable)
                                    <tr wire:click="expandUsers1" class="w-full hover:bg-gray-100 cursor-pointer">
                                        <td colspan="31" class=" text-center p-2">
                                            <div class="flex w-full justify-around">
                                                <span>&darr; expand	&darr;</span>
                                                <span>&darr; expand	&darr;</span>
                                                <span>&darr; expand	&darr;</span>
                                            </div>
                                        </td>
                                    </tr>
                                @endif
                                @if(isset($users2))
                                    @if($users2Expandable)
                                        <tr class="w-full hover:bg-gray-100 cursor-pointer">
                                            <td wire:click="expandUsers2" colspan="31" class=" text-center p-2">
                                                <div class="flex w-full justify-around">
                                                    <span>&uarr; expand	&uarr;</span>
                                                    <span>&uarr; expand	&uarr;</span>
                                                    <span>&uarr; expand	&uarr;</span>
                                                </div>
                                            </td>
                                        </tr>
                                    @endif
                                    @foreach($users2 as $user)
                                        <tr class="border-b border-neutral-200 @if($user->id === auth()->user()->id) bg-black/[0.1] @else bg-black/[0.02] @endif dark:border-white/10">
                                            <td class="whitespace-nowrap p-2">
                                                @if($user->id === auth()->user()->id)
                                                    <div class="h-9"></div>
                                                @else
                                                    <button wire:click="pinUser({{$user->id}})" title="Pin user"
                                                            type="button"
                                                            class="p-1 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 transition-all hover:bg-blue-600 hover:text-white focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">
                                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                             viewBox="0 0 24 24" stroke-width="1.5"
                                                             stroke="currentColor"
                                                             class="w-6 h-6">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                  d="M15 10.5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z"/>
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                  d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1 1 15 0Z"/>
                                                        </svg>
                                                    </button>
                                                @endif
                                            </td>
                                            <td class="whitespace-nowrap px-6 py-2 font-medium">
                                                {{$user->rank}}
                                            </td>
                                            <td class="whitespace-nowrap px-6 py-2 font-medium">
                                                {{$user->name}}
                                            </td>
                                            <td class="whitespace-nowrap px-6 py-2 font-medium">
                                                {{$user->points}}
                                            </td>
                                            @foreach($matches as $match)
                                                <td class="whitespace-nowrap px-1 @if(!isset($user->bets[$match->id])) bg-gray-100/[0.8] @endif">
                                                    <div class="flex justify-center">
                                                        <div class="">
                                                            @if(isset($user->bets[$match->id]))
                                                                <span>{{$user->bets[$match->id]->team_1_score}} : {{$user->bets[$match->id]->team_2_score}}</span>
                                                            @else
                                                                <span class="text-gray-400">- : -</span>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </td>
                                            @endforeach
                                        </tr>
                                    @endforeach
                                @endif
                                </tbody>
                            </table>
                        @else
                            <p>No users found in this community</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
    <script>

        Alpine.data('leaderboard', () => ({
            // users: @this.entangle('users').live,
            // init() {
            //     this.users = @this.entangle('users');
            //     console.log(this.users.length);
            //     for (let i = 0; i < this.users.length; i++) {
            //         console.log(this.users[i]);
            //     }
            // },
        }))
    </script>
@endpush
