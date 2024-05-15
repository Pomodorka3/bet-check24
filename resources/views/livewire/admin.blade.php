<div class="mt-4 grid grid-cols-1 gap-4 sm:flex-row w-full flex-col">
    <div class="w-full p-6 bg-white overflow-hidden shadow-sm rounded-lg">
        <h2 class="text-xl">Runnning matches</h2>
        <div class="flex flex-col w-full">
            <div class="overflow-x-auto">
                <div class="inline-block min-w-full py-2">
                    <div class="overflow-hidden">
                        @if($runningMatches->count() > 0)
                            <table
                                class="min-w-full text-left text-sm font-light text-surface dark:text-white">
                                <thead
                                    class="border-b border-neutral-200 bg-white font-medium dark:border-white/10 dark:bg-body-dark">
                                <tr>
                                    <th scope="col" class="px-6 py-2">Team Home</th>
                                    <th scope="col" class="px-6 py-2">Team Away</th>
                                    <th scope="col" class="px-6 py-2">Date & time</th>
                                    <th scope="col" class="px-6 py-2 text-center">Set score</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($runningMatches as $match)
                                    <tr class="border-b border-neutral-200 bg-black/[0.02] dark:border-white/10">
                                        <td class="whitespace-nowrap px-6 py-2 font-medium">
                                            <div class="flex">
                                                <img class="w-6 h-6"
                                                     src="{{Vite::asset('resources/images/flags/'.$match->team1->countrycode.'.svg')}}"
                                                     alt="{{$match->team1->countrycode}}">
                                                <span class="my-auto ml-2">{{$match->team1->name}}</span>
                                            </div>
                                        </td>
                                        <td class="whitespace-nowrap px-6 py-2">
                                            <div class="flex">
                                                <img class="w-6 h-6"
                                                     src="{{Vite::asset('resources/images/flags/'.$match->team2->countrycode.'.svg')}}"
                                                     alt="{{$match->team2->countrycode}}">
                                                <span class="my-auto ml-2">{{$match->team2->name}}</span>
                                            </div>
                                        </td>
                                        <td class="whitespace-nowrap px-6 py-3">
                                            {{$match->starts_at->format('d.m.Y H:i')}}
                                        </td>
                                        <td>
                                            <div class="flex justify-center">
                                                <input wire:model="scoresToSet.{{$match->id}}" type="text" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Home:Away" required />
                                                <button
                                                    wire:click="setScore({{$match->id}})"
                                                    class="ml-2 bg-blue-500 hover:bg-blue-700 text-white font-bold py-1 px-3 rounded">
                                                    Save
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach

                                </tbody>
                            </table>
                        @else
                            <p>No running matches.</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    @if($status)
        <x-modal :type="$status['type']" :message="$status['message']" show="true"/>
    @endif
</div>