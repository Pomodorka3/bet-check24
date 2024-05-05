<div class="grid grid-cols-1 gap-4 sm:flex-row w-full flex-col" x-cloak x-data="dashboard">

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
                                <th scope="col" class="px-6 py-2 text-center">Bet</th>
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
                                    <td class="whitespace-nowrap px-6 py-3">
                                        {{$match->starts_at->format('d.m.Y H:i')}}
                                    </td>
                                    <td>
                                        <div class="flex justify-center">
                                            @if(isset($match->bet))
                                                <span
                                                    class="my-auto">{{$match->bet->team_1_score}} : {{$match->bet->team_2_score}}</span>
                                                <button
                                                    x-on:click="showModal({{$match->id}}, {{$match->bet->team_1_score}}, {{$match->bet->team_2_score}}, 'update')"
                                                    class="ml-2 bg-blue-500 hover:bg-blue-700 text-white font-bold p-1 rounded">
                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                         viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                                         class="w-6 h-6">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                              d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L6.832 19.82a4.5 4.5 0 0 1-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 0 1 1.13-1.897L16.863 4.487Zm0 0L19.5 7.125"/>
                                                    </svg>
                                                </button>
                                                <button
                                                    wire:click="deleteBet({{$match->bet->id}})"
                                                    class="ml-2 bg-red-500 hover:bg-red-700 text-white font-bold p-1 rounded">
                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                         viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                                         class="w-6 h-6">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                              d="M6 18 18 6M6 6l12 12"/>
                                                    </svg>
                                                </button>
                                            @else
                                                <button
                                                    x-on:click="showModal({{$match->id}}, '', '', 'create')"
                                                    class="ml-2 bg-green-500 hover:bg-green-700 text-white font-bold py-1 px-3 rounded">
                                                    Place bet
                                                </button>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                            @endforeach

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="w-full p-6 bg-white overflow-hidden shadow-sm sm:rounded-lg">
        <h2 class="text-xl">Playing & past matches</h2>
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
                                <th scope="col" class="px-6 py-2">Game start</th>
                                <th scope="col" class="px-6 py-2">Game end</th>
                                <th scope="col" class="px-6 py-2">My bet</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($runningMatches as $match)
                                <tr class="border-b border-neutral-200 bg-black/[0.02] dark:border-white/10">
                                    <td class="whitespace-nowrap px-6 py-2 font-medium">
                                        <div class="flex" title="LIVE">
                                            <span>{{$match->team1->name}}</span>
                                            <div class="ml-2 my-auto relative flex h-4 w-4">
                                              <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-green-400 opacity-75"></span>
                                              <span class="relative inline-flex rounded-full h-4 w-4 bg-green-500"></span>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="whitespace-nowrap px-6 py-2">
                                        {{$match->team2->name}}
                                    </td>
                                    <td class="whitespace-nowrap px-6 py-3">
                                        {{$match->starts_at->format('d.m.Y H:i')}}
                                    </td>
                                    <td class="whitespace-nowrap px-6 py-3">
                                        {{$match->ends_at->format('d.m.Y H:i')}}
                                    </td>
                                    <td></td>
                                </tr>
                            @endforeach

                            @foreach($pastMatches as $match)
                                <tr class="text-gray-400 border-b border-neutral-200 bg-black/[0.08] dark:border-white/10">
                                    <td class="whitespace-nowrap px-6 py-2 font-medium">
                                        {{$match->team1->name}}
                                    </td>
                                    <td class="whitespace-nowrap px-6 py-2">
                                        {{$match->team2->name}}
                                    </td>
                                    <td class="whitespace-nowrap px-6 py-3">
                                        {{$match->starts_at->format('d.m.Y H:i')}}
                                    </td>
                                    <td class="whitespace-nowrap px-6 py-3">
                                        {{$match->ends_at->format('d.m.Y H:i')}}
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

    <x-modal-bet></x-modal-bet>
</div>

@push('scripts')
    <script>
        Alpine.data('dashboard', () => ({
            modalShow: false,
            home: '',
            away: '',
            matchId: '',
            betMode: '',
            showModal(matchId, home, away, betMode) {
                this.modalShow = true;
                this.matchId = matchId;
                this.home = home;
                this.away = away;
                this.betMode = betMode;
            },
        }))
    </script>
@endpush
