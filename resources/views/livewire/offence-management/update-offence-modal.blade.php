<div>
    <!-- Modal -->
    @if($isOpen)
    <div class="fixed inset-0 z-50 flex items-center justify-center bg-gray-800 bg-opacity-75">
        <div class="bg-white p-6 rounded-lg shadow-lg w-2/3 relative">
            <button wire:click="closeModal" class="absolute top-2 right-2 text-gray-500 hover:text-gray-700">
                &times;
            </button>

            <h2 class="text-xl font-semibold mb-4">Update Offence</h2>

            <form wire:submit.prevent="updateOffence">
                <div class="grid grid-cols-3 gap-4">
                    <div class="mb-4">
                        <label for="license_id" class="block text-sm font-medium text-gray-700">License</label>
                        <select wire:model="license_id" id="license_id" class="focus:shadow-[0_0_8px_rgba(0,0,255,0.5)] text-size-sm leading-5.6 ease-soft block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 transition-all focus:outline-none focus:transition-shadow" required>
                            <option value="">Select a license</option>
                            @foreach($licenses as $license)
                                <option value="{{ $license->id }}">{{ $license->license_number }}</option>
                            @endforeach
                        </select>
                        @error('license_id') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    </div>

                    <div class="mb-4">
                        <label for="officer_id" class="block text-sm font-medium text-gray-700">Officer</label>
                        <select wire:model="officer_id" id="officer_id" class="focus:shadow-[0_0_8px_rgba(0,0,255,0.5)] text-size-sm leading-5.6 ease-soft block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 transition-all focus:outline-none focus:transition-shadow" required>
                            <option value="">Select an officer</option>
                            @foreach($officers as $officer)
                                <option value="{{ $officer->id }}">{{ $officer->name }}</option>
                            @endforeach
                        </select>
                        @error('officer_id') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    </div>

                    <div class="mb-4">
                        <label for="vehicle_id" class="block text-sm font-medium text-gray-700">Vehicle</label>
                        <select wire:model="vehicle_id" id="vehicle_id" class="focus:shadow-[0_0_8px_rgba(0,0,255,0.5)] text-size-sm leading-5.6 ease-soft block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 transition-all focus:outline-none focus:transition-shadow" required>
                            <option value="">Select a vehicle</option>
                            @foreach($vehicles as $vehicle)
                                <option value="{{ $vehicle->id }}">{{ $vehicle->plate_number }}</option>
                            @endforeach
                        </select>
                        @error('vehicle_id') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    </div>

                    <div class="mb-4">
                        <label for="violation_id" class="block text-sm font-medium text-gray-700">Violation</label>
                        <select wire:model="violation_id" id="violation_id" class="focus:shadow-[0_0_8px_rgba(0,0,255,0.5)] text-size-sm leading-5.6 ease-soft block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 transition-all focus:outline-none focus:transition-shadow" required>
                            <option value="">Select a violation</option>
                            @foreach($violations as $violation)
                                <option value="{{ $violation->id }}">{{ $violation->violation_name }}</option>
                            @endforeach
                        </select>
                        @error('violation_id') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    </div>

                    <div class="mb-4">
                        <label for="date_time" class="block text-sm font-medium text-gray-700">Date & Time</label>
                        <input wire:model="date_time" type="datetime-local" id="date_time" step="60" class="focus:shadow-[0_0_8px_rgba(0,0,255,0.5)] text-size-sm leading-5.6 ease-soft block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 transition-all focus:outline-none focus:transition-shadow">
                        @error('date_time') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    </div>

                    <div class="mb-4">
                        <label for="location" class="block text-sm font-medium text-gray-700">Location</label>
                        <input wire:model="location" type="text" id="location" placeholder="Location" class="focus:shadow-[0_0_8px_rgba(0,0,255,0.5)] text-size-sm leading-5.6 ease-soft block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 transition-all focus:outline-none focus:transition-shadow" required>
                        @error('location') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    </div>

                    <div class="mb-4">
                        <label for="description" class="block text-sm font-medium text-gray-700">Description</label>
                        <textarea wire:model="description" id="description" placeholder="Description" class="focus:shadow-[0_0_8px_rgba(0,0,255,0.5)] text-size-sm leading-5.6 ease-soft block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 transition-all focus:outline-none focus:transition-shadow"></textarea>
                        @error('description') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    </div>

                    <div class="mb-4">
                        <label for="fine_amount" class="block text-sm font-medium text-gray-700">Fine Amount</label>
                        <input wire:model="fine_amount" type="number" step="0.01" id="fine_amount" placeholder="Fine Amount" class="focus:shadow-[0_0_8px_rgba(0,0,255,0.5)] text-size-sm leading-5.6 ease-soft block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 transition-all focus:outline-none focus:transition-shadow" required>
                        @error('fine_amount') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    </div>
                    <div class="mb-4">
                        <label for="court_date" class="block text-sm font-medium text-gray-700">Court Date</label>
                        <input wire:model="court_date" type="datetime-local" id="court_date" step="60" class="focus:shadow-[0_0_8px_rgba(0,0,255,0.5)] text-size-sm leading-5.6 ease-soft block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 transition-all focus:outline-none focus:transition-shadow">
                        @error('court_date') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    </div>

                    <div class="mb-4">
                        <label for="deadline" class="block text-sm font-medium text-gray-700">Deadline</label>
                        <input wire:model="deadline" type="datetime-local" id="deadline" class="focus:shadow-[0_0_8px_rgba(0,0,255,0.5)] text-size-sm leading-5.6 ease-soft block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 transition-all focus:outline-none focus:transition-shadow" step="60">
                        @error('deadline') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    </div>

                    <div class="mb-4">
                        <label for="status" class="block text-sm font-medium text-gray-700">Status</label>
                        <select wire:model="status" id="status" class="focus:shadow-[0_0_8px_rgba(0,0,255,0.5)] text-size-sm leading-5.6 ease-soft block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 transition-all focus:outline-none focus:transition-shadow" required>
                            <option value="Pending">Pending</option>
                            <option value="Warning">Warning</option>
                            <option value="Paid">Paid</option>
                            <option value="Court">Court</option>
                        </select>
                        @error('status') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    </div>
                </div>

                <div class="flex justify-end mt-4">
                    <button type="button" wire:click="closeModal" class="inline-block px-8 py-2 m-0 text-xs font-bold text-center text-white uppercase align-middle transition-all border-0 rounded-lg cursor-pointer ease-soft-in leading-pro tracking-tight-soft bg-gray-500 shadow-soft-md bg-150 bg-x-25 hover:scale-102 active:opacity-85 mr-3">Cancel</button>
                    <button type="submit" class="inline-block px-8 py-2 m-0 text-xs font-bold text-center text-white uppercase align-middle transition-all border-0 rounded-lg cursor-pointer ease-soft-in leading-pro tracking-tight-soft bg-yellow-500 shadow-soft-md bg-150 bg-x-25 hover:scale-102 active:opacity-85">Update Offence</button>
                </div>
            </form>
        </div>
    </div>
    @endif
</div>
