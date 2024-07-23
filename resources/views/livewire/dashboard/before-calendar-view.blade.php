<div>
    <div class="py-5">
        <div class="flex flex-col gap-2 mt-4 sm:flex-row ">
            <button wire:click="goToPreviousMonth()" type="button"
                class="flex-shrink-0 block w-auto px-3 py-2 text-sm font-semibold text-center text-white transition duration-300 ease-in-out border-2 rounded-md shadow-sm bg-kano-blue border-kano-blue hover:bg-white hover:border-2 hover:border-kano-blue hover:text-kano-blue focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-kano-blue">
                Previous
            </button>
            <button wire:click="goToNextMonth()" type="button"
                class="flex-shrink-0 block w-auto px-3 py-2 text-sm font-semibold text-center text-white transition duration-300 ease-in-out border-2 rounded-md shadow-sm bg-kano-blue border-kano-blue hover:bg-white hover:border-2 hover:border-kano-blue hover:text-kano-blue focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-kano-blue">
                Next
            </button>
            <button wire:click="goToCurrentMonth()" type="button"
                class="flex-shrink-0 block w-auto px-3 py-2 text-sm font-semibold text-center text-white transition duration-300 ease-in-out border-2 rounded-md shadow-sm bg-kano-blue border-kano-blue hover:bg-white hover:border-2 hover:border-kano-blue hover:text-kano-blue focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-kano-blue">
                Current
            </button>

            <div class="mx-auto font-bold">{{ $startsAt->englishMonth }} {{ $startsAt->year }}</div>
        </div>
    </div>
</div>