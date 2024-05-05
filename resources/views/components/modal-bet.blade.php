
<div x-cloak
    x-data="{
        placeBet() {
            $wire.placeBet(this.matchId, this.home, this.away);
            this.resetModal();
        },
        updateBet() {
            $wire.updateBet(this.matchId, this.home, this.away);
            this.resetModal();
        },
        resetModal() {
            this.modalShow = false;
            this.home = '';
            this.away = '';
            this.matchId = '';
            this.betMode = '';
        },
    }"
    x-on:close.stop="modalShow = false"
    x-on:keydown.escape.window="modalShow = false"
    x-on:keydown.tab.prevent="$event.shiftKey || nextFocusable().focus()"
    x-on:keydown.shift.tab.prevent="prevFocusable().focus()"
    x-show="modalShow"
    class="fixed inset-0 overflow-y-auto px-4 py-6 sm:px-0 z-50"
>
    <div
        x-show="modalShow"
        class="fixed inset-0 transform transition-all"
        x-on:click="modalShow = false"
        x-transition:enter="ease-out duration-300"
        x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100"
    >
        <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
    </div>

    <div
        x-show="modalShow"
        x-transition:enter="ease-out duration-300"
        x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
        x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
        id="default-modal" tabindex="-1"
        class="overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
        <div class="flex relative p-4 w-full h-full">
            <!-- Modal content -->
            <div class="m-auto relative bg-white rounded-lg shadow dark:bg-gray-700">
                <!-- Modal header -->
                <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                    <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                        Place a bet
                    </h3>
                    <button x-on:click="modalShow = false" type="button"
                            class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                            data-modal-hide="default-modal">
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                             viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                        </svg>
                        <span class="sr-only">Close modal</span>
                    </button>
                </div>
                <!-- Modal body -->
                <div class="flex p-4 md:p-5 space-y-4">
                    <div class="flex mx-auto">
                        <span class="my-auto">Home</span>
                        <input type="number" name="home"
                               class="w-20 ml-1 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 p-2 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                               x-model="home" placeholder="-" min="0">
                        <span class="font-bold my-auto mx-2">:</span>
                        <input type="number" name="away"
                               class="w-20 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 p-2 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                               x-model="away" placeholder="-" min="0">
                        <span class="my-auto ml-1">Away</span>
                    </div>
                </div>
                <!-- Modal footer -->
                <div class="flex items-center p-4 md:p-5 border-t border-gray-200 rounded-b dark:border-gray-600">
                    <button x-transition x-show="betMode === 'create' && home !== '' && away !== ''" x-on:click="placeBet()"
                            class="mx-auto py-2.5 px-5 bg-green-500 hover:bg-green-700 text-white font-bold rounded">Place Bet
                    </button>
                    <button x-transition x-show="betMode === 'update'" x-on:click="updateBet()"
                            class="mx-auto py-2.5 px-5 bg-blue-500 hover:bg-blue-700 text-white font-bold rounded">Update Bet
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
