<div>
    <!-- Modal -->
    @if($isOpen)
    <div class="fixed inset-0 z-50 flex items-center justify-center bg-gray-800 bg-opacity-75">
        <div class="bg-white p-6 rounded-lg shadow-lg w-1/3 relative">
            <button wire:click="closeModal" class="absolute top-2 right-2 text-gray-500 hover:text-gray-700">
                &times;
            </button>

            <h2 class="text-xl font-semibold mb-4">Update Violation</h2>

            <form wire:submit.prevent="updateViolation">
                <div class="mb-4">
                    <label for="violation_code" class="block text-sm font-medium text-gray-700">Violation Code</label>
                    <input wire:model.blur="violation_code" type="text" id="violation_code" placeholder="Violation Code" aria-label="violation_code" class="focus:shadow-[0_0_8px_rgba(0,0,255,0.5)] text-size-sm leading-5.6 ease-soft block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 transition-all focus:outline-none focus:transition-shadow" required autofocus>
                    @error('violation_code') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>

                <div class="mb-4">
                    <label for="violation_name" class="block text-sm font-medium text-gray-700">Violation Name</label>
                    <input wire:model="violation_name" type="text" id="violation_name" placeholder="Violation Name" aria-label="violation_name" class="focus:shadow-[0_0_8px_rgba(0,0,255,0.5)] text-size-sm leading-5.6 ease-soft block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 transition-all focus:outline-none focus:transition-shadow" required>
                    @error('violation_name') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>

                <div class="mb-4">
                    <label for="description" class="block text-sm font-medium text-gray-700">Description</label>
                    <textarea wire:model="description" id="description" placeholder="Description" aria-label="description" class="focus:shadow-[0_0_8px_rgba(0,0,255,0.5)] text-size-sm leading-5.6 ease-soft block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 transition-all focus:outline-none focus:transition-shadow"></textarea>
                    @error('description') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>

                <div class="mb-4">
                    <label for="fine_amount" class="block text-sm font-medium text-gray-700">Fine Amount</label>
                    <input wire:model="fine_amount" type="number" step="0.01" id="fine_amount" placeholder="Fine Amount" aria-label="fine_amount" class="focus:shadow-[0_0_8px_rgba(0,0,255,0.5)] text-size-sm leading-5.6 ease-soft block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 transition-all focus:outline-none focus:transition-shadow">
                    @error('fine_amount') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>

                <div class="mb-4">
                    <label for="penalty" class="block text-sm font-medium text-gray-700">Penalty</label>
                    <input wire:model="penalty" type="number" id="penalty" placeholder="Penalty" aria-label="penalty" class="focus:shadow-[0_0_8px_rgba(0,0,255,0.5)] text-size-sm leading-5.6 ease-soft block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 transition-all focus:outline-none focus:transition-shadow">
                    @error('penalty') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>

                <div class="mb-4">
                    <label for="status" class="block text-sm font-medium text-gray-700">Status</label>
                    <select wire:model="status" id="status" class="focus:shadow-[0_0_8px_rgba(0,0,255,0.5)] text-size-sm leading-5.6 ease-soft block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 transition-all focus:outline-none focus:transition-shadow" required>
                        <option value="">Select a status</option>
                        <option value="active">Active</option>
                        <option value="inactive">Inactive</option>
                    </select>
                    @error('status') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
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
