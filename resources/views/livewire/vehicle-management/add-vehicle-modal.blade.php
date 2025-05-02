<div>
    <!-- Trigger Button -->
    <button wire:click="openModal" class="inline-block px-8 py-2 m-0 text-xs font-bold text-center text-white uppercase align-middle transition-all border-0 rounded-lg cursor-pointer ease-soft-in leading-pro tracking-tight-soft bg-[#333673] shadow-soft-md bg-150 bg-x-25 hover:scale-102 active:opacity-85">+&nbsp; Add Vehicle</button>

    <!-- Modal -->
    @if($isOpen)
    <div class="fixed inset-0 z-50 flex items-center justify-center bg-gray-800 bg-opacity-75">
        <div class="bg-white p-6 rounded-lg shadow-lg w-1/3 h-2/3 relative overflow-y-auto">
            <button wire:click="closeModal" class="absolute top-2 right-2 text-gray-500 hover:text-gray-700">
                &times;
            </button>

            <h2 class="text-xl font-semibold mb-4">Add Vehicle</h2>

            <form wire:submit.prevent="createVehicle">
                <div class="grid grid-cols-1 gap-4">
                    <div>
                        <label for="plate_number" class="block text-sm font-medium text-gray-700">Plate Number</label>
                        <input wire:model="plate_number" type="text" id="plate_number" placeholder="Plate Number" class="focus:shadow-[0_0_8px_rgba(0,0,255,0.5)] text-size-sm leading-5.6 ease-soft block w-full rounded-lg border border-gray-300 px-3 py-2" required>
                        @error('plate_number') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    </div>
                    <div>
                        <label for="make" class="block text-sm font-medium text-gray-700">Make</label>
                        <input wire:model="make" type="text" id="make" placeholder="Make" class="focus:shadow-[0_0_8px_rgba(0,0,255,0.5)] text-size-sm leading-5.6 ease-soft block w-full rounded-lg border border-gray-300 px-3 py-2" required>
                        @error('make') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    </div>
                    <div>
                        <label for="model" class="block text-sm font-medium text-gray-700">Model</label>
                        <input wire:model="model" type="text" id="model" placeholder="Model" class="focus:shadow-[0_0_8px_rgba(0,0,255,0.5)] text-size-sm leading-5.6 ease-soft block w-full rounded-lg border border-gray-300 px-3 py-2" required>
                        @error('model') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    </div>
                    <div>
                        <label for="color" class="block text-sm font-medium text-gray-700">Color</label>
                        <input wire:model="color" type="text" id="color" placeholder="Color" class="focus:shadow-[0_0_8px_rgba(0,0,255,0.5)] text-size-sm leading-5.6 ease-soft block w-full rounded-lg border border-gray-300 px-3 py-2" required>
                        @error('color') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    </div>
                    <div>
                        <label for="owner_nic" class="block text-sm font-medium text-gray-700">Owner NIC</label>
                        <input wire:model="owner_nic" type="text" id="owner_nic" placeholder="Owner NIC" class="focus:shadow-[0_0_8px_rgba(0,0,255,0.5)] text-size-sm leading-5.6 ease-soft block w-full rounded-lg border border-gray-300 px-3 py-2" required>
                        @error('owner_nic') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    </div>
                    <div>
                        <label for="owner_name" class="block text-sm font-medium text-gray-700">Owner Name</label>
                        <input wire:model="owner_name" type="text" id="owner_name" placeholder="Owner Name" class="focus:shadow-[0_0_8px_rgba(0,0,255,0.5)] text-size-sm leading-5.6 ease-soft block w-full rounded-lg border border-gray-300 px-3 py-2" required>
                        @error('owner_name') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    </div>
                    <div>
                        <label for="owner_contact" class="block text-sm font-medium text-gray-700">Owner Contact</label>
                        <input wire:model="owner_contact" type="text" id="owner_contact" placeholder="Owner Contact" class="focus:shadow-[0_0_8px_rgba(0,0,255,0.5)] text-size-sm leading-5.6 ease-soft block w-full rounded-lg border border-gray-300 px-3 py-2">
                        @error('owner_contact') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    </div>
                    <div>
                        <label for="chassis_number" class="block text-sm font-medium text-gray-700">Chassis Number</label>
                        <input wire:model="chassis_number" type="text" id="chassis_number" placeholder="Chassis Number" class="focus:shadow-[0_0_8px_rgba(0,0,255,0.5)] text-size-sm leading-5.6 ease-soft block w-full rounded-lg border border-gray-300 px-3 py-2" required>
                        @error('chassis_number') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    </div>
                    <div>
                        <label for="engine_number" class="block text-sm font-medium text-gray-700">Engine Number</label>
                        <input wire:model="engine_number" type="text" id="engine_number" placeholder="Engine Number" class="focus:shadow-[0_0_8px_rgba(0,0,255,0.5)] text-size-sm leading-5.6 ease-soft block w-full rounded-lg border border-gray-300 px-3 py-2" required>
                        @error('engine_number') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    </div>
                    <div>
                        <label for="vehicle_type" class="block text-sm font-medium text-gray-700">Vehicle Type</label>
                        <input wire:model="vehicle_type" type="text" id="vehicle_type" placeholder="Vehicle Type" class="focus:shadow-[0_0_8px_rgba(0,0,255,0.5)] text-size-sm leading-5.6 ease-soft block w-full rounded-lg border border-gray-300 px-3 py-2" required>
                        @error('vehicle_type') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    </div>
                    <div>
                        <label for="year_of_manufacture" class="block text-sm font-medium text-gray-700">Year of Manufacture</label>
                        <input wire:model="year_of_manufacture" type="number" id="year_of_manufacture" placeholder="Year" class="focus:shadow-[0_0_8px_rgba(0,0,255,0.5)] text-size-sm leading-5.6 ease-soft block w-full rounded-lg border border-gray-300 px-3 py-2" required>
                        @error('year_of_manufacture') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    </div>
                </div>

                <div class="flex justify-end mt-6">
                    <button type="button" wire:click="closeModal" class="inline-block px-8 py-2 m-0 text-xs font-bold text-center text-white uppercase align-middle transition-all border-0 rounded-lg cursor-pointer ease-soft-in leading-pro tracking-tight-soft bg-gray-500 shadow-soft-md bg-150 bg-x-25 hover:scale-102 active:opacity-85 mr-3">Cancel</button>
                    <button type="submit" class="inline-block px-8 py-2 m-0 text-xs font-bold text-center text-white uppercase align-middle transition-all border-0 rounded-lg cursor-pointer ease-soft-in leading-pro tracking-tight-soft bg-green-900 shadow-soft-md bg-150 bg-x-25 hover:scale-102 active:opacity-85">Create</button>
                </div>
            </form>
        </div>
    </div>
    @endif
</div>
