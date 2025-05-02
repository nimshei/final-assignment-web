<div>
    <!-- Modal -->
    @if($isOpen)
    <div class="fixed inset-0 z-50 flex items-center justify-center bg-gray-800 bg-opacity-75">
        <div class="bg-white p-6 rounded-lg shadow-lg w-1/3 relative">
            <button wire:click="closeModal" class="absolute top-2 right-2 text-gray-500 hover:text-gray-700">
                &times;
            </button>

            <h2 class="text-xl font-semibold mb-4">Update Revenue</h2>

            <form wire:submit.prevent="updateRevenue">
                <div class="mb-4">
                    <label for="vehicle" class="block text-sm font-medium text-gray-700">Select Vehicle</label>
                    <select wire:model="selectedVehicle" id="vehicle" class="focus:shadow-[0_0_8px_rgba(0,0,255,0.5)] text-size-sm leading-5.6 ease-soft block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 transition-all focus:outline-none focus:transition-shadow" required>
                        <option value="">-- Select Vehicle --</option>
                        @foreach($vehicles as $vehicle)
                            <option value="{{ $vehicle->id }}">{{ $vehicle->plate_number }}</option>
                        @endforeach
                    </select>
                    @error('selectedVehicle') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>
                <div class="mb-4">
                    <label for="amount" class="block text-sm font-medium text-gray-700">Amount</label>
                    <input wire:model.blur="amount" type="number" id="amount" placeholder="Enter amount" aria-label="amount" class="focus:shadow-[0_0_8px_rgba(0,0,255,0.5)] text-size-sm leading-5.6 ease-soft block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 transition-all focus:outline-none focus:transition-shadow" required autofocus>
                    @error('amount') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>

                <div class="flex justify-end">
                    <button type="button" wire:click="closeModal" class="inline-block px-8 py-2 m-0 text-xs font-bold text-center text-white uppercase align-middle transition-all border-0 rounded-lg cursor-pointer ease-soft-in leading-pro tracking-tight-soft bg-gray-500 shadow-soft-md bg-150 bg-x-25 hover:scale-102 active:opacity-85 mr-3">Cancel</button>
                    <button type="submit" class="inline-block px-8 py-2 m-0 text-xs font-bold text-center text-white uppercase align-middle transition-all border-0 rounded-lg cursor-pointer ease-soft-in leading-pro tracking-tight-soft bg-yellow-400 shadow-soft-md bg-150 bg-x-25 hover:scale-102 active:opacity-85">Update</button>
                </div>
            </form>
        </div>
    </div>
    @endif
</div>
