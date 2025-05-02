<div class="relative flex flex-col min-w-0 mb-6 break-words bg-white border-0 border-transparent border-solid shadow-soft-xl rounded-2xl bg-clip-border">
    <div class="p-6 pb-0 mb-0 bg-white border-b-0 border-b-solid rounded-t-2xl border-b-transparent flex justify-between items-center">
            <div>
                <h6>All License details</h6>
                <p>Here you can manage license.</p>
            </div>
            <div class="my-auto">
                @livewire('license-management.add-license-modal')
            </div>
    </div>
    <!-- Filters Section -->
    <div class="flex items-center justify-between px-6 py-4">
        <div class="flex items-center space-x-3">

            <!-- Active Status Filter -->
            <select wire:model.live="selectedActiveStatus" class="pr-5 md:w-40 placeholder-gray-400/70 pl-3 text-size-sm leading-5.6 ease-soft block appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-2 py-1 font-normal text-gray-700 transition-all focus:outline-none focus:transition-shadow">
                <option value="">All Status</option>
                <option value="1">Active</option>
                <option value="0">Inactive</option>
            </select>

            <!-- License Type Filter -->
            <select wire:model.live="selectedLicenseType" class="pr-5 md:w-40 placeholder-gray-400/70 pl-3 text-size-sm leading-5.6 ease-soft block appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-2 py-1 font-normal text-gray-700 transition-all focus:outline-none focus:transition-shadow">
                <option value="">All License Types</option>
                @foreach ($licenseTypes as $licenseType)
                    <option value="{{ $licenseType }}">{{ $licenseType }}</option>
                @endforeach
            </select>

            <!-- Expiry Date Filter -->
            <input type="date" wire:model.live="expiryDate" class="pr-5 placeholder-gray-400/70 pl-3 text-size-sm leading-5.6 ease-soft block appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-2 py-1 font-normal text-gray-700 transition-all focus:outline-none focus:transition-shadow">
        </div>
        <div class="flex items-center space-x-3">
            <div class="relative flex items-center">
                <span class="absolute">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-4 mx-4 text-gray-400 dark:text-gray-600">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z" />
                    </svg>
                </span>
                <input type="text" wire:model.live="search" placeholder="Search by name, license NO, or ID" class=" pr-5 md:w-80 placeholder-gray-400/70 pl-11 rtl:pr-11 rtl:pl-5 text-size-sm leading-5.6 ease-soft block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-2 py-1 font-normal text-gray-700 transition-all focus:outline-none focus:transition-shadow">
            </div>
            <button wire:click="refresh" class="inline-block px-3 py-2 text-xs font-bold text-center text-white uppercase align-middle transition-all border-0 rounded-lg cursor-pointer ease-soft-in leading-pro tracking-tight-soft bg-[#333673] shadow-soft-md bg-150 bg-x-25 hover:scale-102 active:opacity-85">
                <i class="fas fa-sync-alt"></i>
            </button>
        </div>
    </div>


    <div class="flex-auto px-0 pt-0 pb-2">
        <div class="p-0 overflow-x-auto">
            <table class="items-center w-full mb-0 align-top border-gray-200 text-slate-500">
                <thead class="align-bottom">
                    <tr>
                        <th class="px-6 py-3 font-bold text-left uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-size-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">
                            ID</th>
                        <th class="px-6 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-size-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">
                            Active Status</th>
                            <th class="px-6 py-3 font-bold text-left uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-size-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">
                            Panelties</th>
                        <th class="px-6 py-3 pl-2 font-bold text-left uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-size-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">
                            License Holder</th>
                        <th class="px-6 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-size-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">
                            License Number</th>
                        <th class="px-6 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-size-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">
                            Issued Date</th>
                        <th class="px-6 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-size-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">
                            Expiry Date</th>
                        <th class="px-6 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-size-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">
                            ID Type</th>
                        <th class="px-6 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-size-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">
                            ID Number</th>
                        <th class="px-6 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-size-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">
                            Date of Birth</th>
                        <th class="px-6 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-size-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">
                            Age</th>
                        <th class="px-6 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-size-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">
                            Sex</th>
                        <th class="px-6 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-size-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">
                            Permanent Address</th>
                        <th class="px-6 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-size-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">
                            Phone Number</th>
                        <th class="px-6 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-size-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">
                            Blood Group</th>
                        <th class="px-6 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-size-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">
                            Organ Donor</th>
                        <th class="px-6 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-size-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">
                            Height</th>
                        <th class="px-6 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-size-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">
                            Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($licenses as $license)
                        <tr>
                            <td class="pl-6 align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                                <p class="mb-0 font-semibold leading-tight text-size-xs">{{ $license->id }}</p>
                            </td>
                            <td class="p-2 text-center align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                                <div class="inline-block w-20 px-2 py-0.5 m-0 text-xxs font-bold text-center text-white uppercase align-middle transition-all border-0 rounded-lg cursor-pointer ease-soft-in leading-pro tracking-tight-soft shadow-soft-md bg-150 bg-x-25 hover:scale-102 active:opacity-85 {{ $license->active_status ? 'bg-green-500' : 'bg-red-500' }}">
                                    {{ $license->active_status ? 'Active' : 'Inactive' }}
                                </div>
                            </td>
                            <td class="p-2 text-center align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                                <div class="inline-block w-20 px-2 py-0.5 m-0 text-xxs font-bold text-center text-white uppercase align-middle transition-all border-0 rounded-lg cursor-pointer ease-soft-in leading-pro tracking-tight-soft shadow-soft-md bg-150 bg-x-25 hover:scale-102 active:opacity-85 {{ $license->total_penalty > 0 ? 'bg-red-500' : 'bg-green-500' }}">
                                    {{ $license->total_penalty > 0 ? $license->total_penalty : 'No Penalty' }}
                                </div>
                            </td>
                            <td class="p-2 align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                                <p class="mb-0 font-semibold leading-tight text-size-xs">{{ $license->user->name }}</p>
                            </td>
                            <td class="p-2 text-center align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                                <p class="mb-0 font-semibold leading-tight text-size-xs">{{ $license->license_number }}</p>
                            </td>
                            <td class="p-2 text-center align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                                <p class="mb-0 font-semibold leading-tight text-size-xs">{{ $license->issue_date ? \Carbon\Carbon::parse($license->issue_date)->format('d/m/Y') : 'N/A' }}</p>
                            </td>
                            <td class="p-2 text-center align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                                <p class="mb-0 font-semibold leading-tight text-size-xs">{{ $license->expiry_date ? \Carbon\Carbon::parse($license->expiry_date)->format('d/m/Y') : 'N/A' }}</p>
                            </td>
                            <td class="p-2 text-center align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                                <p class="mb-0 font-semibold leading-tight text-size-xs">{{ $license->id_type }}</p>
                            </td>
                            <td class="p-2 text-center align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                                <p class="mb-0 font-semibold leading-tight text-size-xs">{{ $license->id_number }}</p>
                            </td>
                            <td class="p-2 text-center align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                                <p class="mb-0 font-semibold leading-tight text-size-xs">{{ $license->date_of_birth }}</p>
                            </td>
                            <td class="p-2 text-center align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                                <p class="mb-0 font-semibold leading-tight text-size-xs">{{ $license->age }}</p>
                            </td>
                            <td class="p-2 text-center align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                                <p class="mb-0 font-semibold leading-tight text-size-xs">
                                    @if ($license->sex === 'Male')
                                        <i class="fas fa-mars text-blue-500 mr-2"></i> Male
                                    @elseif ($license->sex === 'Female')
                                        <i class="fas fa-venus text-pink-500 mr-2"></i> Female
                                    @else
                                        <i class="fas fa-genderless text-gray-500 mr-2"></i> Other
                                    @endif
                                </p>
                            </td>
                            <td class="p-2 text-center align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                                <p class="mb-0 font-semibold leading-tight text-size-xs">{{ $license->permanent_address }}</p>
                            </td>
                            <td class="p-2 text-center align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                                <p class="mb-0 font-semibold leading-tight text-size-xs">{{ $license->phone_number }}</p>
                            </td>
                            <td class="p-2 text-center align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                                <p class="mb-0 font-semibold leading-tight text-size-xs">
                                    <i class="fas fa-tint text-red-500 mr-2"></i> {{ $license->blood_group }}
                                </p>
                            </td>
                            <td class="p-2 text-center align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                                <p class="inline-block px-2 py-0.5 m-0 text-xxs font-bold text-center text-white uppercase align-middle transition-all border-0 rounded-lg cursor-pointer ease-soft-in leading-pro tracking-tight-soft shadow-soft-md bg-150 bg-x-25 hover:scale-102 active:opacity-85 {{ $license->organ_donor_status ? 'bg-red-500' : 'bg-green-500' }}">
                                    {{ $license->organ_donor_status ? 'Yes' : 'No' }}
                                </p>
                            </td>
                            <td class="p-2 text-center align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                                <p class="mb-0 font-semibold leading-tight text-size-xs">{{ $license->height }}</p>
                            </td>
                            <td class="p-2 text-center align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                                <div class="grid grid-cols-2 gap-1 justify-center w-80">
                                    <button wire:click="toggleActiveStatus({{ $license->id }})" 
                                            class="w-30 inline-block px-3 py-1 m-0 text-xs font-bold text-center text-white uppercase align-middle transition-all border-0 rounded-lg cursor-pointer ease-soft-in leading-pro tracking-tight-soft {{ $license->active_status ? 'bg-red-500' : 'bg-green-500' }} shadow-soft-md bg-150 bg-x-25 hover:scale-102 active:opacity-85">
                                        <i class="fas {{ $license->active_status ? 'fa-times-circle' : 'fa-check-circle' }} mr-1"></i>
                                        {{ $license->active_status ? 'Deactivate' : 'Activate' }}
                                    </button>
                                    <div class="flex space-x-2">
                                        <button wire:click="$dispatch('openUpdateLicenseModal', [{{ $license->id }}])" 
                                                class="w-20 inline-block px-3 py-1 m-0 text-xs font-bold text-center text-white uppercase align-middle transition-all border-0 rounded-lg cursor-pointer ease-soft-in leading-pro tracking-tight-soft bg-yellow-400 shadow-soft-md bg-150 bg-x-25 hover:scale-102 active:opacity-85">
                                            Update
                                        </button>
                                        <button wire:click="deleteLicense({{ $license->id }})" 
                                                class="w-20 inline-block px-3 py-1 m-0 text-xs font-bold text-center text-white uppercase align-middle transition-all border-0 rounded-lg cursor-pointer ease-soft-in leading-pro tracking-tight-soft bg-red-500 shadow-soft-md bg-150 bg-x-25 hover:scale-102 active:opacity-85">
                                            Delete
                                        </button>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="mt-4 px-6">
            {{ $licenses->links() }}
      </div>
    </div>
    <livewire:license-management.update-license-modal />
</div>