<div>
    @if($isOpen)
    <div class="fixed inset-0 z-50 flex items-center justify-center bg-gray-800 bg-opacity-75">
        <div class="bg-white p-6 rounded-lg shadow-lg w-2/3 h-2/3 relative overflow-y-auto">
            <button wire:click="closeModal" class="absolute top-2 right-2 text-gray-500 hover:text-gray-700">
                &times;
            </button>

            <h2 class="text-xl font-semibold mb-4">Update License</h2>

            <form wire:submit.prevent="updateLicense">
                 <!-- Personal Information Section -->
                 <h3 class="text-lg font-semibold mb-4">Login Details</h3>
                 <div class="grid grid-cols-3 gap-4 mb-4">
                     <div>
                         <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                         <input wire:model="email" type="email" id="email" placeholder="Email" disabled class="focus:shadow-[0_0_8px_rgba(0,0,255,0.5)] text-size-sm leading-5.6 ease-soft block w-full rounded-lg border border-gray-300 px-3 py-2" required>
                         @error('email') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                     </div>
                     <div>
                         <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                         <input wire:model="password" type="password" id="password" placeholder="Password" value="Password" disabled class="focus:shadow-[0_0_8px_rgba(0,0,255,0.5)] text-size-sm leading-5.6 ease-soft block w-full rounded-lg border border-gray-300 px-3 py-2" required>
                         @error('password') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                     </div>
                     <div>
                         <label for="confirm_password" class="block text-sm font-medium text-gray-700">Confirm Password</label>
                         <input  type="password" id="confirm_password" placeholder="Confirm Password" value="Password" disabled class="focus:shadow-[0_0_8px_rgba(0,0,255,0.5)] text-size-sm leading-5.6 ease-soft block w-full rounded-lg border border-gray-300 px-3 py-2" required>
                         @error('confirm_password') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                     </div>
                 </div>
                <!-- Personal Information Section -->
                <h3 class="text-lg font-semibold mb-4">Personal Information</h3>
                <div class="grid grid-cols-3 gap-4">
                    <div>
                        <label for="name" class="block text-sm font-medium text-gray-700">Name</label>
                        <input wire:model="name" type="text" id="name" placeholder="Name" class="focus:shadow-[0_0_8px_rgba(0,0,255,0.5)] text-size-sm leading-5.6 ease-soft block w-full rounded-lg border border-gray-300 px-3 py-2" required>
                        @error('name') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    </div>
                    <div>
                        <label for="id_type" class="block text-sm font-medium text-gray-700">ID Type</label>
                        <select wire:model="id_type" id="id_type" class="focus:shadow-[0_0_8px_rgba(0,0,255,0.5)] text-size-sm leading-5.6 ease-soft block w-full rounded-lg border border-gray-300 px-3 py-2" required>
                            <option value="">Select</option>
                            <option value="National ID">National ID</option>
                            <option value="Passport">Passport</option>
                            <option value="Driving License">Driving License</option>
                        </select>
                        @error('id_type') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    </div>
                    <div>
                        <label for="id_number" class="block text-sm font-medium text-gray-700">ID Number</label>
                        <input wire:model="id_number" type="text" id="id_number" placeholder="ID Number" class="focus:shadow-[0_0_8px_rgba(0,0,255,0.5)] text-size-sm leading-5.6 ease-soft block w-full rounded-lg border border-gray-300 px-3 py-2" required>
                        @error('id_number') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    </div>
                    <div>
                        <label for="date_of_birth" class="block text-sm font-medium text-gray-700">Date of Birth</label>
                        <input wire:model="date_of_birth" type="date" id="date_of_birth" class="focus:shadow-[0_0_8px_rgba(0,0,255,0.5)] text-size-sm leading-5.6 ease-soft block w-full rounded-lg border border-gray-300 px-3 py-2" required>
                        @error('date_of_birth') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    </div>
                    <div>
                        <label for="age" class="block text-sm font-medium text-gray-700">Age</label>
                        <input wire:model="age" type="number" id="age" placeholder="Age" class="focus:shadow-[0_0_8px_rgba(0,0,255,0.5)] text-size-sm leading-5.6 ease-soft block w-full rounded-lg border border-gray-300 px-3 py-2" required>
                        @error('age') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    </div>
                    <div>
                        <label for="sex" class="block text-sm font-medium text-gray-700">Sex</label>
                        <select wire:model="sex" id="sex" class="focus:shadow-[0_0_8px_rgba(0,0,255,0.5)] text-size-sm leading-5.6 ease-soft block w-full rounded-lg border border-gray-300 px-3 py-2" required>
                            <option value="">Select</option>
                            <option value="Male">Male</option>
                            <option value="Female">Female</option>
                        </select>
                        @error('sex') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    </div>
                    <div>
                        <label for="phone_number" class="block text-sm font-medium text-gray-700">Phone Number</label>
                        <input wire:model="phone_number" type="text" id="phone_number" placeholder="Phone Number" class="focus:shadow-[0_0_8px_rgba(0,0,255,0.5)] text-size-sm leading-5.6 ease-soft block w-full rounded-lg border border-gray-300 px-3 py-2" required>
                        @error('phone_number') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    </div>
                    <div class="w-full col-span-3">
                        <label for="permanent_address" class="block text-sm font-medium text-gray-700">Permanent Address</label>
                        <textarea wire:model="permanent_address" id="permanent_address" placeholder="Permanent Address" class="focus:shadow-[0_0_8px_rgba(0,0,255,0.5)] text-size-sm leading-5.6 ease-soft block w-full rounded-lg border border-gray-300 px-3 py-2" required></textarea>
                        @error('permanent_address') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    </div>
                </div>

                <!-- License Details Section -->
                <h3 class="text-lg font-semibold mt-6 mb-4">License Details</h3>
                <div class="grid grid-cols-3 gap-4">
                    <div>
                        <label for="license_number" class="block text-sm font-medium text-gray-700">License Number</label>
                        <input wire:model="license_number" type="text" id="license_number" placeholder="License Number" class="focus:shadow-[0_0_8px_rgba(0,0,255,0.5)] text-size-sm leading-5.6 ease-soft block w-full rounded-lg border border-gray-300 px-3 py-2" required>
                        @error('license_number') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    </div>
                    <div>
                        <label for="issued_date" class="block text-sm font-medium text-gray-700">Issued Date</label>
                        <input wire:model.lazy="issue_date" type="date" id="issued_date" class="focus:shadow-[0_0_8px_rgba(0,0,255,0.5)] text-size-sm leading-5.6 ease-soft block w-full rounded-lg border border-gray-300 px-3 py-2" required
                               wire:change="updateExpiryDate">
                        @error('issue_date') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    </div>
                    <div>
                        <label for="expiry_date" class="block text-sm font-medium text-gray-700">Expiry Date</label>
                        <input wire:model="expiry_date" type="date" id="expiry_date" class="focus:shadow-[0_0_8px_rgba(0,0,255,0.5)] text-size-sm leading-5.6 ease-soft block w-full rounded-lg border border-gray-300 px-3 py-2" readonly>
                        @error('expiry_date') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    </div>
                    <div>
                        <label for="divisional_secretariat_code" class="block text-sm font-medium text-gray-700">Divisional Secretariat Code</label>
                        <input wire:model="divisional_secretariat_code" type="text" id="divisional_secretariat_code" placeholder="Code" class="focus:shadow-[0_0_8px_rgba(0,0,255,0.5)] text-size-sm leading-5.6 ease-soft block w-full rounded-lg border border-gray-300 px-3 py-2" required>
                        @error('divisional_secretariat_code') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    </div>
                    <div>
                        <label for="blood_group" class="block text-sm font-medium text-gray-700">Blood Group</label>
                        <select wire:model="blood_group" id="blood_group" class="focus:shadow-[0_0_8px_rgba(0,0,255,0.5)] text-size-sm leading-5.6 ease-soft block w-full rounded-lg border border-gray-300 px-3 py-2" required>
                            <option value="">Select</option>
                            <option value="A+">A+</option>
                            <option value="A-">A-</option>
                            <option value="B+">B+</option>
                            <option value="B-">B-</option>
                            <option value="AB+">AB+</option>
                            <option value="AB-">AB-</option>
                            <option value="O+">O+</option>
                            <option value="O-">O-</option>
                        </select>
                        @error('blood_group') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    </div>
                    <div>
                        <label for="organ_donor_status" class="block text-sm font-medium text-gray-700">Organ Donor Status</label>
                        <select wire:model="organ_donor_status" id="organ_donor_status" class="focus:shadow-[0_0_8px_rgba(0,0,255,0.5)] text-size-sm leading-5.6 ease-soft block w-full rounded-lg border border-gray-300 px-3 py-2" required>
                            <option value="">Select</option>
                            <option value="1">Yes</option>
                            <option value="0">No</option>
                        </select>
                        @error('organ_donor_status') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    </div>
                    <div>
                        <label for="height" class="block text-sm font-medium text-gray-700">Height</label>
                        <input wire:model="height" type="text" id="height" placeholder="Height" class="focus:shadow-[0_0_8px_rgba(0,0,255,0.5)] text-size-sm leading-5.6 ease-soft block w-full rounded-lg border border-gray-300 px-3 py-2" required>
                        @error('height') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    </div>
                </div>

                <div class="flex justify-end mt-6">
                    <button type="button" wire:click="closeModal" class="inline-block px-8 py-2 m-0 text-xs font-bold text-center text-white uppercase align-middle transition-all border-0 rounded-lg cursor-pointer ease-soft-in leading-pro tracking-tight-soft bg-gray-500 shadow-soft-md bg-150 bg-x-25 hover:scale-102 active:opacity-85 mr-3">Cancel</button>
                    <button type="submit" class="inline-block px-8 py-2 m-0 text-xs font-bold text-center text-white uppercase align-middle transition-all border-0 rounded-lg cursor-pointer ease-soft-in leading-pro tracking-tight-soft bg-yellow-500 shadow-soft-md bg-150 bg-x-25 hover:scale-102 active:opacity-85">Update</button>
                </div>
            </form>
        </div>
    </div>
    @endif
</div>
