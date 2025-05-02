<div class="flex flex-wrap -mx-3">
    <div class="flex-none w-full max-w-full px-3">
        <div class="relative flex flex-col min-w-0 mb-6 break-words bg-white border-0 border-transparent border-solid shadow-soft-xl rounded-2xl bg-clip-border">
            <div class="p-6 pb-0 mb-0 bg-white border-b-0 border-b-solid rounded-t-2xl border-b-transparent flex justify-between items-center">
                <div>
                    <h6>All Vehicles</h6>
                    <p>Here you can manage vehicle revenue records.</p>
                </div>
                <div class="my-auto">
                    @livewire('revenue-management.add-revenue-modal')
                </div>
            </div>

        <!-- Filters Section -->
        <div class="flex items-center justify-between px-6 py-4">
            <div class="flex items-center space-x-3">
                <!-- Vehicle Type Filter -->
                <select wire:model.live="selectedVehicleType" class="pr-5 placeholder-gray-400/70 pl-3 text-size-sm md:w-40 leading-5.6 ease-soft block appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-2 py-1 font-normal text-gray-700 transition-all focus:outline-none focus:transition-shadow">
                    <option value="">All Vehicle Types</option>
                    @foreach ($vehicleTypes as $type)
                        <option value="{{ $type->vehicle_type }}">{{ $type->vehicle_type }}</option>
                    @endforeach
                </select>

                <!-- Date Filter -->
                <input type="date" wire:model.live="createdDate" class="pr-5 placeholder-gray-400/70 pl-3 text-size-sm leading-5.6 ease-soft block appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-2 py-1 font-normal text-gray-700 transition-all focus:outline-none focus:transition-shadow">
            </div>

            <div class="flex items-center space-x-3">
                <div class="relative flex items-center">
                    <span class="absolute">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-4 mx-4 text-gray-400 dark:text-gray-600">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z" />
                        </svg>
                    </span>
                    <input type="text" wire:model.live="search" placeholder="Search by plate number, make, or model" class="pr-5 md:w-60 placeholder-gray-400/70 pl-11 rtl:pr-11 rtl:pl-5 text-size-sm leading-5.6 ease-soft block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-2 py-1 font-normal text-gray-700 transition-all focus:outline-none focus:transition-shadow">
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
                            <th class="px-6 py-3 font-bold text-left uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-size-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">ID</th>
                            <th class="px-6 py-3 font-bold text-left uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-size-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">Status</th>
                            <th class="px-6 py-3 font-bold text-left uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-size-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">Plate Number</th>
                            <th class="px-6 py-3 font-bold text-left uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-size-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">Make</th>
                            <th class="px-6 py-3 font-bold text-left uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-size-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">Model</th>
                            <th class="px-6 py-3 font-bold text-left uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-size-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">Chassis Number</th>
                            <th class="px-6 py-3 font-bold text-left uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-size-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">Vehicle Type</th>
                            <th class="px-6 py-3 font-bold text-left uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-size-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">Revenue Issue Date</th>
                            <th class="px-6 py-3 font-bold text-left uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-size-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">Revenue Expiry Date</th>
                            <th class="px-6 py-3 font-bold text-left uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-size-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">Fee Paid</th>
                            <th class="px-6 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-size-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($vehicles as $vehicle)
                            <tr wire:key="vehicle-{{ $vehicle->id }}">
                                <td class="pl-6 align-middle bg-transparent border-b whitespace-nowrap shadow-transparent text-center">
                                    <p class="mb-0 font-semibold leading-tight text-size-xs">{{ $vehicle->id }}</p>
                                </td>
                                <td class="p-2 text-center align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                                    <div class="inline-block w-20 px-2 py-0.5 m-0 text-xxs font-bold text-center text-white uppercase align-middle transition-all border-0 rounded-lg cursor-pointer ease-soft-in leading-pro tracking-tight-soft shadow-soft-md bg-150 bg-x-25 hover:scale-102 active:opacity-85 {{ optional($vehicle->revenueLicenses)->expiry_date && now()->greaterThan($vehicle->revenueLicenses->expiry_date) ? 'bg-red-500' : 'bg-green-500' }}">
                                        {{ optional($vehicle->revenueLicenses)->expiry_date && now()->greaterThan($vehicle->revenueLicenses->expiry_date) ? 'Expired' : 'Active' }}
                                    </div>
                                </td>
                                <td class="p-2 text-center align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                                    <p class="mb-0 font-semibold leading-tight text-size-xs">{{ $vehicle->plate_number }}</p>
                                </td>
                                <td class="p-2 text-center align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                                    <p class="mb-0 font-semibold leading-tight text-size-xs">{{ $vehicle->make }}</p>
                                </td>
                                <td class="p-2 text-center align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                                    <p class="mb-0 font-semibold leading-tight text-size-xs">{{ $vehicle->model }}</p>
                                </td>
                                <td class="p-2 text-center align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                                    <p class="mb-0 font-semibold leading-tight text-size-xs">{{ $vehicle->chassis_number }}</p>
                                </td>
                                <td class="p-2 text-center align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                                    <p class="mb-0 font-semibold leading-tight text-size-xs">{{ $vehicle->vehicle_type }}</p>
                                </td>
                                <td class="p-2 text-center align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                                    <p class="mb-0 font-semibold leading-tight text-size-xs">
                                        {{ $vehicle->revenueLicenses->issue_date ?? 'N/A' }}
                                    </p>
                                </td>
                                <td class="p-2 text-center align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                                    <p class="mb-0 font-semibold leading-tight text-size-xs">
                                        {{ $vehicle->revenueLicenses->expiry_date ?? 'N/A' }}
                                    </p>
                                </td>
                                <td class="p-2 text-center align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                                    <p class="mb-0 font-semibold leading-tight text-size-xs">
                                        {{ $vehicle->revenueLicenses->fee_paid ?? 'N/A' }}
                                    </p>
                                </td>
                                <td class="p-2 text-center align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                                    <p class="mb-0 font-semibold leading-tight text-base">
                                        <button wire:click="$dispatch('openUpdateRevenueModal', [{{ $vehicle->id }}])" class="inline-block px-3 py-1 m-0 text-xs font-bold text-center text-white uppercase align-middle transition-all border-0 rounded-lg cursor-pointer ease-soft-in leading-pro tracking-tight-soft bg-yellow-400 shadow-soft-md bg-150 bg-x-25 hover:scale-102 active:opacity-85">
                                            update
                                        </button>
                                        <button wire:click="deleteRevenueLicense({{ $vehicle->id }})" class="inline-block px-3 py-1 m-0 text-xs font-bold text-center text-white uppercase align-middle transition-all border-0 rounded-lg cursor-pointer ease-soft-in leading-pro tracking-tight-soft bg-red-500 shadow-soft-md bg-150 bg-x-25 hover:scale-102 active:opacity-85">
                                            delete
                                        </button>
                                    </p>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="mt-4 px-6">
                {{ $vehicles->links() }}
            </div>
        </div>
    </div>
    <livewire:revenue-management.update-revenue-modal/>
</div>