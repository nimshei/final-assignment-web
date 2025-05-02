<div class="flex flex-wrap -mx-3">
    <div class="flex-none w-full max-w-full px-3">
        <div class="relative flex flex-col min-w-0 mb-6 break-words bg-white border-0 border-transparent border-solid shadow-soft-xl rounded-2xl bg-clip-border">
            <div class="p-6 pb-0 mb-0 bg-white border-b-0 border-b-solid rounded-t-2xl border-b-transparent flex justify-between items-center">
                <div>
                    <h6>All Accidents</h6>
                    <p>Here you can manage accidents.</p>
                </div>
                <div class="my-auto">
                    @livewire('accident-management.add-accident-modal')
                </div>
            </div>

            <!-- Filters Section -->
            <div class="flex items-center justify-between px-6 py-4">
                <div class="flex items-center space-x-3">

                    <!-- Status Filter -->
                    <select wire:model.live="selectedStatus" class="pr-5 placeholder-gray-400/70 pl-3 text-size-sm md:w-30 leading-5.6 ease-soft block appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-2 py-1 font-normal text-gray-700 transition-all focus:outline-none focus:transition-shadow">
                        <option value="">All Statuses</option>
                        <option value="Pending">Pending</option>
                        <option value="Investigating">Investigating</option>
                        <option value="Resolved">Resolved</option>
                        <option value="Closed">Closed</option>
                    </select>

                    <!-- Severity Filter -->
                    <select wire:model.live="selectedSeverity" class="pr-5 placeholder-gray-400/70 pl-3 text-size-sm md:w-30 leading-5.6 ease-soft block appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-2 py-1 font-normal text-gray-700 transition-all focus:outline-none focus:transition-shadow">
                        <option value="">All Severities</option>
                        <option value="Minor">Minor</option>
                        <option value="Moderate">Moderate</option>
                        <option value="Severe">Severe</option>
                        <option value="Fatal">Fatal</option>
                    </select>

                    <!-- Date Filter -->
                    <input type="date" wire:model.live="accidentDate" class="pr-5 placeholder-gray-400/70 pl-3 text-size-sm leading-5.6 ease-soft block appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-2 py-1 font-normal text-gray-700 transition-all focus:outline-none focus:transition-shadow">
                </div>

                <div class="flex items-center space-x-3">
                    <div class="relative flex items-center">
                        <span class="absolute">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-4 mx-4 text-gray-400 dark:text-gray-600">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z" />
                            </svg>
                        </span>
                        <input type="text" wire:model.live="searchLocation" placeholder="Search by location, plate number, or officer" class="pr-5 md:w-60 placeholder-gray-400/70 pl-11 rtl:pr-11 rtl:pl-5 text-size-sm leading-5.6 ease-soft block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-2 py-1 font-normal text-gray-700 transition-all focus:outline-none focus:transition-shadow">
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
                                    Status</th>
                                <th class="px-6 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-size-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">
                                    Severity</th>
                                <th class="px-6 py-3 pl-2 font-bold text-left uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-size-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">
                                    Officer</th>
                                <th class="px-6 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-size-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">
                                    Date & Time</th>
                                <th class="px-6 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-size-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">
                                    Injuries</th>
                                <th class="px-6 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-size-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">
                                    Fatalities</th>
                                <th class="px-6 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-size-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">
                                    Property Damage</th>
                                <th class="px-6 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-size-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">
                                    Vehicles</th>
                                <th class="px-6 py-3 pl-2 font-bold text-left uppercase bg-transparent border-b border-gray-200 shadow-none text-size-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">
                                    Location</th>
                                <th class="px-6 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-size-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">
                                    Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($accidents as $accident)
                                <tr>
                                    <td class="pl-6 align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                                        <p class="mb-0 font-semibold leading-tight text-size-xs">{{ $accident->id }}</p>
                                    </td>
                                    <td class="p-2 text-center align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                                        <div class="inline-block w-24 px-2 py-0.5 m-0 text-xxs font-bold text-center text-white uppercase align-middle transition-all border-0 rounded-lg cursor-pointer ease-soft-in leading-pro tracking-tight-soft shadow-soft-md bg-150 bg-x-25 hover:scale-102 active:opacity-85 
                                            {{ $accident->status === 'Pending' ? 'bg-gray-500' : ($accident->status === 'Investigating' ? 'bg-yellow-500' : ($accident->status === 'Resolved' ? 'bg-green-500' : ($accident->status === 'Closed' ? 'bg-red-500' : 'bg-gray-500'))) }}">
                                            {{ $accident->status }}
                                        </div>
                                    </td>
                                    <td class="p-2 text-center align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                                        <div class="inline-block w-20 px-2 py-0.5 m-0 text-xxs font-bold text-center text-white uppercase align-middle transition-all border-0 rounded-lg cursor-pointer ease-soft-in leading-pro tracking-tight-soft shadow-soft-md bg-150 bg-x-25 hover:scale-102 active:opacity-85 
                                            {{ $accident->severity === 'Minor' ? 'bg-green-500' : ($accident->severity === 'Moderate' ? 'bg-yellow-500' : ($accident->severity === 'Severe' ? 'bg-orange-500' : ($accident->severity === 'Fatal' ? 'bg-red-500' : 'bg-gray-500'))) }}">
                                            {{ $accident->severity }}
                                        </div>
                                    </td>
                                    <td class="p-2 align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                                        <p class="mb-0 font-semibold leading-tight text-size-xs">{{ $accident->officer->name }}</p>
                                    </td>
                                    <td class="p-2 text-center align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                                        <p class="mb-0 font-semibold leading-tight text-size-xs">{{ \Carbon\Carbon::parse($accident->accident_date_time)->format('d/m/Y H:i') }}</p>
                                    </td>
                                    <td class="p-2 text-center align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                                        <p class="mb-0 font-semibold leading-tight text-size-xs">{{ $accident->injuries }}</p>
                                    </td>
                                    <td class="p-2 text-center align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                                        <p class="mb-0 font-semibold leading-tight text-size-xs">{{ $accident->fatalities }}</p>
                                    </td>
                                    <td class="p-2 text-center align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                                        <p class="mb-0 font-semibold leading-tight text-size-xs">{{ number_format($accident->property_damage, 2) }} LKR</p>
                                    </td>
                                    <td class="p-2 align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                                        <p class="mb-0 font-semibold leading-tight text-size-xs">
                                            @if ($accident->plate_numbers)
                                                @foreach (explode(',', $accident->plate_numbers) as $plateNumber)
                                                    <span class="inline-block px-2 py-1 text-xs font-bold text-white bg-blue-500 rounded">{{ $plateNumber }}</span>
                                                @endforeach
                                            @endif
                                        </p>
                                    </td>
                                    <td class="p-2 align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                                        <a href="https://www.google.com/maps/search/?api=1&query={{ urlencode($accident->location) }}" target="_blank" class="text-blue-500">
                                            <button class="inline-block px-3 py-1 m-0 text-xs font-bold text-center text-white uppercase align-middle transition-all border-0 rounded-lg cursor-pointer ease-soft-in leading-pro tracking-tight-soft bg-green-500 shadow-soft-md bg-150 bg-x-25 hover:scale-102 active:opacity-85">
                                                <i class="fas fa-map-marker-alt"></i> View Location
                                            </button>
                                        </a>
                                    </td>
                                    <td class="p-2 text-center align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                                        <p class="mb-0 font-semibold leading-tight text-base">
                                            {{-- <button wire:click="$dispatch('openViewAccidentModal', { note: '{{ $accident->note }}', description: '{{ $accident->description }}' })" class="inline-block px-3 py-1 m-0 text-xs font-bold text-center text-white uppercase align-middle transition-all border-0 rounded-lg cursor-pointer ease-soft-in leading-pro tracking-tight-soft bg-blue-500 shadow-soft-md bg-150 bg-x-25 hover:scale-102 active:opacity-85">
                                                view
                                            </button> --}}
                                            <button wire:click="$dispatch('openUpdateAccidentModal', [{{ $accident->id }}])" class="inline-block px-3 py-1 m-0 text-xs font-bold text-center text-white uppercase align-middle transition-all border-0 rounded-lg cursor-pointer ease-soft-in leading-pro tracking-tight-soft bg-yellow-400 shadow-soft-md bg-150 bg-x-25 hover:scale-102 active:opacity-85">
                                                update
                                            </button>
                                            <button wire:click="deleteAccident({{ $accident->id }})" class="inline-block px-3 py-1 m-0 text-xs font-bold text-center text-white uppercase align-middle transition-all border-0 rounded-lg cursor-pointer ease-soft-in leading-pro tracking-tight-soft bg-red-500 shadow-soft-md bg-150 bg-x-25 hover:scale-102 active:opacity-85">
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
                    {{ $accidents->links() }}
              </div>
            </div>
        </div>
    </div>
    <livewire:accident-management.update-accident-modal />
    <livewire.accident-management.view-accident-modal/>
</div>
