<div>
    <div class="p-6">
        <h2 class="text-xl">Communities you are part of:</h2>
        <div class="flex flex-col w-full">
            <div class="overflow-x-auto sm:-mx-6 lg:-mx-8">
                <div class="inline-block min-w-full py-2 sm:px-6 lg:px-8">
                    <div class="overflow-hidden">
                        <table
                            class="min-w-full text-left text-sm font-light text-surface dark:text-white">
                            <thead
                                class="border-b border-neutral-200 bg-white font-medium dark:border-white/10 dark:bg-body-dark">
                            <tr>
                                <th scope="col" class="px-6 py-2">Name</th>
                                <th scope="col" class="px-6 py-2">Participants</th>
                                <th scope="col" class="px-6 py-2">Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($userCommunities as $community)
                                <tr
                                        @if($community->created_by === auth()->user()->id)
                                            class="border-b border-neutral-200 bg-black/[0.10] dark:border-white/10"
                                        @else
                                            class="border-b border-neutral-200 bg-black/[0.02] dark:border-white/10"
                                        @endif
                                >
                                    <td class="whitespace-nowrap px-6 py-2 font-medium">{{$community->name}}</td>
                                    <td class="whitespace-nowrap px-6 py-2">
                                        <div class="flex">
                                                    <span>
                                                        {{$community->users->count()}}/5
                                                    </span>
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                 stroke-width="1.5" stroke="currentColor" class="w-5 h-5 ml-1">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                      d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z"/>
                                            </svg>
                                        </div>
                                    </td>
                                    <td class="whitespace-nowrap px-6 py-3 flex">
                                        <a href="{{route('community.show', $community->id)}}"
                                           title="Community info"
                                           class="mr-1 text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg p-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="m11.25 11.25.041-.02a.75.75 0 0 1 1.063.852l-.708 2.836a.75.75 0 0 0 1.063.853l.041-.021M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9-3.75h.008v.008H12V8.25Z" />
                                            </svg>
                                        </a>
                                        @if($community->created_by === auth()->user()->id)
                                            <form method='POST' action="{{route('community.destroy', $community->id)}}">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                        title="Disband community"
                                                        class="focus:outline-none text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg p-2 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-900"
                                                    >
                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                                        <path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                                                    </svg>
                                                </button>
                                            </form>
{{--                                            <a href="{{route('community.destroy', $community->id)}}"--}}
{{--                                               title="Disband community"--}}
{{--                                               class="focus:outline-none text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg p-2 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-900">--}}
{{--                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">--}}
{{--                                                    <path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />--}}
{{--                                                </svg>--}}
{{--                                            </a>--}}
                                        @else
                                            <a href="{{route('community.leave', $community->id)}}"
                                               title="Leave community"
                                               class="focus:outline-none text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg p-2 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-900">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M22 10.5h-6m-2.25-4.125a3.375 3.375 0 1 1-6.75 0 3.375 3.375 0 0 1 6.75 0ZM4 19.235v-.11a6.375 6.375 0 0 1 12.75 0v.109A12.318 12.318 0 0 1 10.374 21c-2.331 0-4.512-.645-6.374-1.766Z" />
                                                </svg>
                                            </a>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach

                            </tbody>
                        </table>
                    </div>
                    <div class="flex mt-4">
                        <a href="{{route('community.create')}}"
                           class="flex py-2 px-4 font-bold text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="text-green-700 w-7 h-7">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                            </svg>
                            <span class="my-auto ml-1">Create own community</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <hr>

    <div class="p-6">
        <h2 class="text-xl">All communities:</h2>
        <div class="flex flex-col w-full">
            <div class="overflow-x-auto sm:-mx-6 lg:-mx-8">
                <div class="inline-block min-w-full py-2 sm:px-6 lg:px-8">
                    <div class="overflow-hidden">
                        <table
                                class="min-w-full text-left text-sm font-light text-surface dark:text-white">
                            <thead
                                    class="border-b border-neutral-200 bg-white font-medium dark:border-white/10 dark:bg-body-dark">
                            <tr>
                                <th scope="col" class="px-6 py-2">Name</th>
                                <th scope="col" class="px-6 py-2">Participants</th>
                                <th scope="col" class="px-6 py-2">Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($communities as $community)
                                <tr
                                        @if($community->created_by === auth()->user()->id)
                                            class="border-b border-neutral-200 bg-black/[0.10] dark:border-white/10"
                                        @else
                                            class="border-b border-neutral-200 bg-black/[0.02] dark:border-white/10"
                                        @endif
                                >
                                    <td class="whitespace-nowrap px-6 py-2 font-medium">{{$community->name}}</td>
                                    <td class="whitespace-nowrap px-6 py-2">
                                        <div class="flex">
                                                    <span>
                                                        {{$community->users->count()}}/5
                                                    </span>
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                 stroke-width="1.5" stroke="currentColor" class="w-5 h-5 ml-1">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                      d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z"/>
                                            </svg>
                                        </div>
                                    </td>
                                    <td class="whitespace-nowrap px-6 py-3 flex">
                                        <a href="{{route('community.show', $community->id)}}"
                                           title="Community info"
                                           class="mr-1 text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg p-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="m11.25 11.25.041-.02a.75.75 0 0 1 1.063.852l-.708 2.836a.75.75 0 0 0 1.063.853l.041-.021M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9-3.75h.008v.008H12V8.25Z" />
                                            </svg>
                                        </a>
                                        @if($community->created_by !== auth()->user()->id)
                                            <a href="{{route('community.join', $community->id)}}"
                                               title="Join community"
                                                class="focus:outline-none text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg p-2 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M18 7.5v3m0 0v3m0-3h3m-3 0h-3m-2.25-4.125a3.375 3.375 0 1 1-6.75 0 3.375 3.375 0 0 1 6.75 0ZM3 19.235v-.11a6.375 6.375 0 0 1 12.75 0v.109A12.318 12.318 0 0 1 9.374 21c-2.331 0-4.512-.645-6.374-1.766Z" />
                                                </svg>

                                            </a>
                                        @endif
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
</div>
