<div>
    <!-- Modal -->
    @if($isOpen)
    <div class="fixed inset-0 z-50 flex items-center justify-center bg-gray-800 bg-opacity-75">
        <div class="bg-white p-8 rounded-lg shadow-lg w-2/3 relative">
            <button wire:click="closeModal" class="absolute top-2 right-2 text-gray-500 hover:text-gray-700">
                &times;
            </button>

            <h2 class="text-2xl font-semibold mb-6">Update Accident</h2>

            <form wire:submit.prevent="updateAccident">
                <div class="grid grid-cols-4 gap-6">
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
                        <label for="accident_date_time" class="block text-sm font-medium text-gray-700">Date & Time</label>
                        <input wire:model="accident_date_time" type="datetime-local" id="accident_date_time" class="focus:shadow-[0_0_8px_rgba(0,0,255,0.5)] text-size-sm leading-5.6 ease-soft block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 transition-all focus:outline-none focus:transition-shadow" step="60" required>
                        @error('accident_date_time') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    </div>

                    <div class="mb-4">
                        <label for="location" class="block text-sm font-medium text-gray-700">Location</label>
                        <input wire:model="location" type="text" id="location" placeholder="Location" class="focus:shadow-[0_0_8px_rgba(0,0,255,0.5)] text-size-sm leading-5.6 ease-soft block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 transition-all focus:outline-none focus:transition-shadow" required>
                        @error('location') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    </div>

                    <div class="mb-4">
                        <label for="severity" class="block text-sm font-medium text-gray-700">Severity</label>
                        <select wire:model="severity" id="severity" class="focus:shadow-[0_0_8px_rgba(0,0,255,0.5)] text-size-sm leading-5.6 ease-soft block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 transition-all focus:outline-none focus:transition-shadow" required>
                            <option value="Minor">Minor</option>
                            <option value="Moderate">Moderate</option>
                            <option value="Severe">Severe</option>
                            <option value="Fatal">Fatal</option>
                        </select>
                        @error('severity') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    </div>

                    <div class="mb-4 col-span-4">
                        <label for="description" class="block text-sm font-medium text-gray-700">Description</label>
                        <textarea wire:model="description" id="description" placeholder="Description" class="focus:shadow-[0_0_8px_rgba(0,0,255,0.5)] text-size-sm leading-5.6 ease-soft block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 transition-all focus:outline-none focus:transition-shadow"></textarea>
                        @error('description') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    </div>

                    <div class="mb-4">
                        <label for="injuries" class="block text-sm font-medium text-gray-700">Injuries</label>
                        <input wire:model="injuries" type="number" id="injuries" placeholder="Number of Injuries" class="focus:shadow-[0_0_8px_rgba(0,0,255,0.5)] text-size-sm leading-5.6 ease-soft block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 transition-all focus:outline-none focus:transition-shadow" required>
                        @error('injuries') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    </div>

                    <div class="mb-4">
                        <label for="fatalities" class="block text-sm font-medium text-gray-700">Fatalities</label>
                        <input wire:model="fatalities" type="number" id="fatalities" placeholder="Number of Fatalities" class="focus:shadow-[0_0_8px_rgba(0,0,255,0.5)] text-size-sm leading-5.6 ease-soft block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 transition-all focus:outline-none focus:transition-shadow" required>
                        @error('fatalities') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    </div>

                    <div class="mb-4">
                        <label for="property_damage" class="block text-sm font-medium text-gray-700">Property Damage</label>
                        <input wire:model="property_damage" type="number" step="0.01" id="property_damage" placeholder="Property Damage Amount" class="focus:shadow-[0_0_8px_rgba(0,0,255,0.5)] text-size-sm leading-5.6 ease-soft block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 transition-all focus:outline-none focus:transition-shadow" required>
                        @error('property_damage') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    </div>

                    <div class="mb-4">
                        <label for="status" class="block text-sm font-medium text-gray-700">Status</label>
                        <select wire:model="status" id="status" class="focus:shadow-[0_0_8px_rgba(0,0,255,0.5)] text-size-sm leading-5.6 ease-soft block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 transition-all focus:outline-none focus:transition-shadow" required>
                            <option value="Pending">Pending</option>
                            <option value="Investigating">Investigating</option>
                            <option value="Resolved">Resolved</option>
                            <option value="Closed">Closed</option>
                        </select>
                        @error('status') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    </div>

                    <div class="mb-4 col-span-4">
                        <label for="notes" class="block text-sm font-medium text-gray-700">Notes</label>
                        <textarea wire:model="notes" id="notes" placeholder="Additional Notes" class="focus:shadow-[0_0_8px_rgba(0,0,255,0.5)] text-size-sm leading-5.6 ease-soft block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 transition-all focus:outline-none focus:transition-shadow"></textarea>
                        @error('notes') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    </div>

                    <!-- Dynamic Vehicle Inputs -->
                    <div class="mb-4 col-span-4">
                        <label class="block text-sm font-medium text-gray-700">Vehicles Involved</label>
                        @foreach($vehicleInputs as $index => $vehicleInput)
                            <div class="flex items-center mb-2">
                                <select wire:model="vehicleInputs.{{ $index }}" class="focus:shadow-[0_0_8px_rgba(0,0,255,0.5)] text-size-sm leading-5.6 ease-soft block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 transition-all focus:outline-none focus:transition-shadow" required>
                                    <option value="">Select a vehicle</option>
                                    @foreach($vehicles as $vehicle)
                                        <option value="{{ $vehicle->id }}">{{ $vehicle->plate_number }}</option>
                                    @endforeach
                                </select>
                                <button type="button" wire:click="removeVehicle({{ $index }})" class="ml-2 text-red-500 hover:text-red-700">Remove</button>
                            </div>
                            @error("vehicleInputs.{$index}") <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                        @endforeach
                        <button type="button" wire:click="addVehicle" class="inline-block px-4 py-1 text-xs font-bold text-center text-white uppercase align-middle transition-all border-0 rounded-lg cursor-pointer ease-soft-in leading-pro tracking-tight-soft bg-blue-500 shadow-soft-md bg-150 bg-x-25 hover:scale-102 active:opacity-85 mt-2">+ Add Vehicle</button>
                    </div>
                </div>

                <div class="flex justify-end mt-6">
                    <button type="button" wire:click="closeModal" class="inline-block px-8 py-2 m-0 text-xs font-bold text-center text-white uppercase align-middle transition-all border-0 rounded-lg cursor-pointer ease-soft-in leading-pro tracking-tight-soft bg-gray-500 shadow-soft-md bg-150 bg-x-25 hover:scale-102 active:opacity-85 mr-3">Cancel</button>
                    <button type="submit" class="inline-block px-8 py-2 m-0 text-xs font-bold text-center text-white uppercase align-middle transition-all border-0 rounded-lg cursor-pointer ease-soft-in leading-pro tracking-tight-soft bg-yellow-400 shadow-soft-md bg-150 bg-x-25 hover:scale-102 active:opacity-85">Update Accident</button>
                </div>
            </form>
        </div>
    </div>
    @endif
</div>
