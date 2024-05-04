<div class="grid grid-cols-1 gap-4 sm:flex-row w-full flex-col" x-data="dashboard">

    <div class="w-full p-6 bg-white overflow-hidden shadow-sm rounded-lg">
        <h2 class="text-xl">Upcoming matches</h2>
        <div class="flex flex-col w-full">
            <div class="overflow-x-auto">
                <div class="inline-block min-w-full py-2">
                    <div class="overflow-hidden">
                        <table
                            class="min-w-full text-left text-sm font-light text-surface dark:text-white">
                            <thead
                                class="border-b border-neutral-200 bg-white font-medium dark:border-white/10 dark:bg-body-dark">
                            <tr>
                                <th scope="col" class="px-6 py-2">Team Home</th>
                                <th scope="col" class="px-6 py-2">Team Away</th>
                                <th scope="col" class="px-6 py-2">Date & time</th>
                                <th scope="col" class="px-6 py-2">Place bet</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($upcomingMatches as $match)
                                <tr class="border-b border-neutral-200 bg-black/[0.02] dark:border-white/10">
                                    <td class="whitespace-nowrap px-6 py-2 font-medium">
                                        {{$match->team1->name}}
                                    </td>
                                    <td class="whitespace-nowrap px-6 py-2">
                                        {{$match->team2->name}}
                                    </td>
                                    <td class="whitespace-nowrap px-6 py-3 flex">
                                        {{$match->starts_at->format('d.m.Y H:i')}}
                                    </td>
                                    <td>
                                        @if(isset($match->bet))
                                            <button wire:click="updateBet()"
                                                    class="ml-2 bg-blue-500 hover:bg-blue-700 text-white font-bold my-1 px-3 rounded">
                                                Change
                                            </button>
                                        @else
                                            <button
                                                    x-on:click="showModal({{$match->id}}, '', '')"
                                                    class="ml-2 bg-green-500 hover:bg-green-700 text-white font-bold my-1 px-3 rounded">
                                                Bet
                                            </button>
                                        @endif
                                        {{--                                            <div class="flex mx-auto" x-cloak--}}
                                        {{--                                                 x-data="{home: @if(isset($match->bet)) {{$match->bet->team_1_score}} @else '' @endif,--}}
                                        {{--                                                  away: @if(isset($match->bet)) {{$match->bet->team_2_score}} @else '' @endif,--}}
                                        {{--                                                  matchId: {{$match->id}}}">--}}
                                        {{--                                                <span class="my-auto">Home</span>--}}
                                        {{--                                                <input type="number" name="home" class="ml-1 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 w-12 p-2 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"--}}
                                        {{--                                                       x-model="home" placeholder="-" min="0">--}}
                                        {{--                                                <span class="font-bold my-auto mx-2">:</span>--}}
                                        {{--                                                <input type="number" name="away" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 w-12 p-2 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"--}}
                                        {{--                                                       x-model="away" placeholder="-" min="0">--}}
                                        {{--                                                <span class="my-auto ml-1">Away</span>--}}
                                        {{--                                                <span x-text="matchId"></span>--}}
                                        {{--                                                @if(isset($match->bet))--}}
                                        {{--                                                    <button wire:click="updateBet()" class="ml-2 bg-blue-500 hover:bg-blue-700 text-white font-bold my-1 px-3 rounded">Change</button>--}}
                                        {{--                                                @else--}}
                                        {{--                                                    <button x-transition x-show="home !== '' && away !== ''" @click="$wire.placeBet({{$match->id}}, home, away)" class="ml-2 bg-green-500 hover:bg-green-700 text-white font-bold my-1 px-3 rounded">Bet</button>--}}
                                        {{--                                                @endif--}}
                                        {{--                                            </div>--}}
                                    </td>
                                </tr>
                            @endforeach
                            <x-modal-bet></x-modal-bet>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="w-full p-6 bg-white overflow-hidden shadow-sm sm:rounded-lg">
        <h2 class="text-xl">Playing matches</h2>
        <div class="flex flex-col w-full">
            <div class="overflow-x-auto">
                <div class="inline-block min-w-full py-2">
                    <div class="overflow-hidden">
                        <table
                            class="min-w-full text-left text-sm font-light text-surface dark:text-white">
                            <thead
                                class="border-b border-neutral-200 bg-white font-medium dark:border-white/10 dark:bg-body-dark">
                            <tr>
                                <th scope="col" class="px-6 py-2">Team Home</th>
                                <th scope="col" class="px-6 py-2">Team Away</th>
                                <th scope="col" class="px-6 py-2">Date & time</th>
                                <th scope="col" class="px-6 py-2">Place bet</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($runningMatches as $match)
                                <tr class="border-b border-neutral-200 bg-black/[0.02] dark:border-white/10">
                                    <td class="whitespace-nowrap px-6 py-2 font-medium">
                                        {{$match->team1->name}}
                                    </td>
                                    <td class="whitespace-nowrap px-6 py-2">
                                        {{$match->team2->name}}
                                    </td>
                                    <td class="whitespace-nowrap px-6 py-3 flex">
                                        {{$match->starts_at->format('d.m.Y H:i')}}
                                    </td>
                                    <td></td>
                                </tr>
                            @endforeach

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
    <script>
        Alpine.data('dashboard', () => ({
            modalShow: false,
            home: '',
            away: '',
            matchId: '',
            showModal(matchId, home, away) {
                this.modalShow = true;
                this.matchId = matchId;
                this.home = home;
                this.away = away;
            },
        }))
    </script>
@endpush
