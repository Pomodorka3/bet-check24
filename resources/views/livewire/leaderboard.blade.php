<div class="mt-4 grid grid-cols-1 gap-4 sm:flex-row w-full flex-col" x-cloak x-data="leaderboard">

    <div class="w-full p-6 bg-white overflow-hidden shadow-sm rounded-lg">
        <h2 class="text-xl">Leaderboard</h2>
        <div class="flex flex-col w-full">
            <div class="overflow-x-auto">
                <div class="inline-block min-w-full py-2">
                    <div class="overflow-hidden">
                        <table
                            class="min-w-full text-left text-sm font-light text-surface dark:text-white">
                            <thead
                                class="border-b border-neutral-200 bg-white font-medium dark:border-white/10 dark:bg-body-dark">
                            <tr>
                                <th scope="col" class="px-6 py-2">Position</th>
                                <th scope="col" class="px-6 py-2">Username</th>
                                <th scope="col" class="px-6 py-2">Points</th>
{{--                                <th scope="col" class="px-6 py-2 text-center"></th>--}}
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($users as $user)
                                <tr class="border-b border-neutral-200 bg-black/[0.02] dark:border-white/10">
                                    <td class="whitespace-nowrap px-6 py-2 font-medium">
                                        {{$user->rank}}
                                    </td>
                                    <td class="whitespace-nowrap px-6 py-2 font-medium">
                                        {{$user->name}}
                                    </td>
                                    <td class="whitespace-nowrap px-6 py-2 font-medium">
                                        {{$user->points}}
                                    </td>
                                </tr>
{{--                                    <td class="whitespace-nowrap px-6 py-2">--}}
{{--                                        {{$match->team2->name}}--}}
{{--                                    </td>--}}
{{--                                    <td class="whitespace-nowrap px-6 py-3">--}}
{{--                                        {{$match->starts_at->format('d.m.Y H:i')}}--}}
{{--                                    </td>--}}
{{--                                    <td>--}}
{{--                                        <div class="flex justify-center">--}}
{{--                                            @if(isset($match->bet))--}}
{{--                                                <span--}}
{{--                                                    class="my-auto">{{$match->bet->team_1_score}} : {{$match->bet->team_2_score}}</span>--}}
{{--                                                <button--}}
{{--                                                    x-on:click="showModal({{$match->id}}, {{$match->bet->team_1_score}}, {{$match->bet->team_2_score}}, 'update')"--}}
{{--                                                    class="ml-2 bg-blue-500 hover:bg-blue-700 text-white font-bold p-1 rounded">--}}
{{--                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none"--}}
{{--                                                         viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"--}}
{{--                                                         class="w-6 h-6">--}}
{{--                                                        <path stroke-linecap="round" stroke-linejoin="round"--}}
{{--                                                              d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L6.832 19.82a4.5 4.5 0 0 1-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 0 1 1.13-1.897L16.863 4.487Zm0 0L19.5 7.125"/>--}}
{{--                                                    </svg>--}}
{{--                                                </button>--}}
{{--                                                <button--}}
{{--                                                    wire:click="deleteBet({{$match->bet->id}})"--}}
{{--                                                    class="ml-2 bg-red-500 hover:bg-red-700 text-white font-bold p-1 rounded">--}}
{{--                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none"--}}
{{--                                                         viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"--}}
{{--                                                         class="w-6 h-6">--}}
{{--                                                        <path stroke-linecap="round" stroke-linejoin="round"--}}
{{--                                                              d="M6 18 18 6M6 6l12 12"/>--}}
{{--                                                    </svg>--}}
{{--                                                </button>--}}
{{--                                            @else--}}
{{--                                                <button--}}
{{--                                                    x-on:click="showModal({{$match->id}}, '', '', 'create')"--}}
{{--                                                    class="ml-2 bg-green-500 hover:bg-green-700 text-white font-bold py-1 px-3 rounded">--}}
{{--                                                    Place bet--}}
{{--                                                </button>--}}
{{--                                            @endif--}}
{{--                                        </div>--}}
{{--                                    </td>--}}
{{--                                </tr>--}}
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
