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
                                @if($community->id === 1)
                                <tr class="border-b border-neutral-200 bg-black/[0.10] dark:border-white/10">
                                    <td class="whitespace-nowrap px-6 py-2 font-medium">
                                        <div class="flex">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M18 18.72a9.094 9.094 0 0 0 3.741-.479 3 3 0 0 0-4.682-2.72m.94 3.198.001.031c0 .225-.012.447-.037.666A11.944 11.944 0 0 1 12 21c-2.17 0-4.207-.576-5.963-1.584A6.062 6.062 0 0 1 6 18.719m12 0a5.971 5.971 0 0 0-.941-3.197m0 0A5.995 5.995 0 0 0 12 12.75a5.995 5.995 0 0 0-5.058 2.772m0 0a3 3 0 0 0-4.681 2.72 8.986 8.986 0 0 0 3.74.477m.94-3.197a5.971 5.971 0 0 0-.94 3.197M15 6.75a3 3 0 1 1-6 0 3 3 0 0 1 6 0Zm6 3a2.25 2.25 0 1 1-4.5 0 2.25 2.25 0 0 1 4.5 0Zm-13.5 0a2.25 2.25 0 1 1-4.5 0 2.25 2.25 0 0 1 4.5 0Z" />
                                            </svg>
                                            <span class="my-auto ml-1">
                                                {{$community->name}}
                                            </span>
                                        </div>
                                    </td>
                                    <td class="whitespace-nowrap px-6 py-2">
                                        <div class="flex">
                                                    <span>
                                                        {{$community->users->count()}}
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
                                    </td>
                                </tr>
                                @else
                                    <tr
                                        @if($community->created_by === auth()->user()->id)
                                            class="border-b border-neutral-200 bg-black/[0.10] dark:border-white/10"
                                        @else
                                            class="border-b border-neutral-200 bg-black/[0.02] dark:border-white/10"
                                        @endif
                                    >
                                        <td class="whitespace-nowrap px-6 py-2 font-medium">
                                            <div class="flex">
                                                @if($community->created_by === auth()->user()->id)
                                                    <div title="You are creator">
                                                        <svg class="w-6 h-6" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                            <path d="M18.53 19.24H5.4C5.24283 19.2414 5.0893 19.1927 4.96164 19.101C4.83399 19.0094 4.73885 18.8794 4.69 18.73L1.5 9C1.45113 8.86009 1.446 8.70861 1.4853 8.56571C1.52459 8.42281 1.60646 8.29525 1.72 8.2C1.83214 8.10161 1.97141 8.03941 2.11953 8.02157C2.26764 8.00372 2.4177 8.03106 2.55 8.1L8.37 11L11.37 5.18C11.4392 5.06398 11.5373 4.9679 11.6547 4.90118C11.7722 4.83446 11.9049 4.79938 12.04 4.79938C12.1751 4.79938 12.3078 4.83446 12.4253 4.90118C12.5427 4.9679 12.6408 5.06398 12.71 5.18L15.71 11.01L21.54 8.11C21.6708 8.0419 21.8191 8.01501 21.9655 8.03286C22.1119 8.05071 22.2494 8.11247 22.36 8.21C22.4557 8.31491 22.5197 8.44486 22.5445 8.58471C22.5693 8.72456 22.5539 8.86858 22.5 9L19.24 18.72C19.1929 18.8713 19.0985 19.0034 18.9707 19.097C18.8429 19.1906 18.6884 19.2407 18.53 19.24ZM6 17.74H18L20.51 10.25L15.64 12.67C15.5528 12.7146 15.4576 12.7415 15.3599 12.749C15.2623 12.7566 15.1641 12.7446 15.071 12.7139C14.978 12.6832 14.892 12.6344 14.818 12.5702C14.744 12.506 14.6835 12.4278 14.64 12.34L12 7.16L9.37 12.34C9.32648 12.4278 9.26596 12.506 9.19197 12.5702C9.11798 12.6344 9.03197 12.6832 8.93895 12.7139C8.84593 12.7446 8.74774 12.7566 8.65007 12.749C8.5524 12.7415 8.45721 12.7146 8.37 12.67L3.48 10.22L6 17.74Z" fill="#000000"/>
                                                        </svg>
                                                    </div>
                                                @endif
                                                <span class="my-auto ml-1">
                                                {{$community->name}}
                                            </span>
                                            </div>
                                        </td>
                                        <td class="whitespace-nowrap px-6 py-2">
                                            <div class="flex">
                                                    <span>
                                                        {{$community->users->count()}}
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
                                @endif
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
                                                        {{$community->users->count()}}
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
                                        @if($community->created_by !== auth()->user()->id && auth()->user()->communities->count() < 5)
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
