<div>
    <!-- Modal -->
    @if($isOpen)
    <div class="fixed inset-0 z-50 flex items-center justify-center bg-gray-800 bg-opacity-75">
        <div class="bg-white p-8 rounded-lg shadow-lg w-2/3 relative">
            <button wire:click="closeModal" class="absolute top-2 right-2 text-gray-500 hover:text-gray-700">
                &times;
            </button>

            <h2 class="text-2xl font-semibold mb-6">Accident Details</h2>

            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700">Description</label>
                <p class="text-gray-800">{{ $description }}</p>
            </div>

            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700">Note</label>
                <p class="text-gray-800">{{ $note }}</p>
            </div>

            <div class="flex justify-end mt-6">
                <button type="button" wire:click="closeModal" class="inline-block px-8 py-2 m-0 text-xs font-bold text-center text-white uppercase align-middle transition-all border-0 rounded-lg cursor-pointer ease-soft-in leading-pro tracking-tight-soft bg-gray-500 shadow-soft-md bg-150 bg-x-25 hover:scale-102 active:opacity-85">Close</button>
            </div>
        </div>
    </div>
    @endif
</div>
