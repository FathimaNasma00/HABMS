<x-guest-layout>
    <div class="mx-auto sm:px-6 lg:px-8">

        <div class="w-full" x-data="getDoctors()" x-init="get()">
            <div class="flex justify-between">
                <p class="mb-6 text-lg font-semibold">Doctors</p>
                <div x-data="formModel()">
                    <button @click="open()" type="button"
                            class="cursor-pointer  px-4 py-2 text-sm font-bold text-white rounded-[30px] border-2 border-white bg-gradient-to-r from-blue-400
               to-green-400 hover:from-blue-500 hover:to-green-500 focus:outline-none focus:ring-2 focus:ring-blue-400 focus:ring-offset-1">
                        Add New Doctor
                    </button>
                    <div x-cloak x-show="modalIsOpen" x-transition.opacity.duration.200ms
                         x-trap.inert.noscroll="modalIsOpen"
                         @keydown.esc.window="modalIsOpen = false" @click.self="modalIsOpen = false"
                         class="fixed inset-0 z-30 flex items-end justify-center bg-black/20 p-4 pb-8 backdrop-blur-md sm:items-center lg:p-8"
                         role="dialog" aria-modal="true" aria-labelledby="defaultModalTitle">
                        <!-- Modal Dialog -->
                        <div x-show="modalIsOpen"
                             x-transition:enter="transition ease-out duration-200 delay-100 motion-reduce:transition-opacity"
                             x-transition:enter-start="opacity-0 scale-50"
                             x-transition:enter-end="opacity-100 scale-100"
                             class="flex w-full max-w-2xl flex-col gap-4 overflow-hidden rounded-md border border-neutral-300 bg-white text-neutral-600 ">
                            <!-- Dialog Header -->
                            <div class="flex items-center justify-between border-b border-neutral-300 bg-neutral-50/60 p-4">
                                <h3 id="defaultModalTitle" class="font-semibold tracking-wide text-neutral-900">Add New
                                    Doctor</h3>
                                <button @click="modalIsOpen = false" aria-label="close modal">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" aria-hidden="true"
                                         stroke="currentColor" fill="none" stroke-width="1.4" class="w-5 h-5">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/>
                                    </svg>
                                </button>
                            </div>
                            <form @submit.prevent="submitForm">
                                <!-- Dialog Body -->
                                <div class="px-8 pb-4">
                                    @csrf
                                    <div class="flex w-full flex-col gap-1"
                                         x-on:keydown="handleKeydownOnOptions($event)"
                                         x-on:keydown.esc.window="isOpen = false, openedWithKeyboard = false"
                                         x-init="options = allOptions">
                                        <label for="make"
                                               class="w-fit pl-0.5 text-sm text-neutral-600 ">Speciality</label>
                                        <div class="relative">

                                            <!-- trigger button  -->
                                            <button type="button"
                                                    class="inline-flex w-full items-center justify-between gap-2 border border-neutral-300 rounded-md bg-neutral-50 px-4 py-2 text-sm font-medium tracking-wide text-neutral-600 transition hover:opacity-75 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-black "
                                                    role="combobox" aria-controls="makesList" aria-haspopup="listbox"
                                                    x-on:click="isOpen = ! isOpen"
                                                    x-on:keydown.down.prevent="openedWithKeyboard = true"
                                                    x-on:keydown.enter.prevent="openedWithKeyboard = true"
                                                    x-on:keydown.space.prevent="openedWithKeyboard = true"
                                                    x-bind:aria-expanded="isOpen || openedWithKeyboard"
                                                    x-bind:aria-label="selectedOption ? selectedOption.value : 'Please Select'">
                                <span class="text-sm font-normal"
                                      x-text="selectedOption ? selectedOption.value : 'Please Select'"></span>
                                                <!-- Chevron  -->
                                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                                                     fill="currentColor"
                                                     class="size-5" aria-hidden="true">
                                                    <path fill-rule="evenodd"
                                                          d="M5.22 8.22a.75.75 0 0 1 1.06 0L10 11.94l3.72-3.72a.75.75 0 1 1 1.06 1.06l-4.25 4.25a.75.75 0 0 1-1.06 0L5.22 9.28a.75.75 0 0 1 0-1.06Z"
                                                          clip-rule="evenodd"/>
                                                </svg>
                                            </button>

                                            <!-- Hidden Input To Grab The Selected Value  -->
                                            <input id="specialtie" x-model="formData.specialtie" name="specialtie"
                                                   x-ref="hiddenTextField" hidden=""/>
                                            <div x-show="isOpen || openedWithKeyboard" id="makesList"
                                                 class="absolute left-0 top-11 z-10 w-full overflow-hidden rounded-md border border-neutral-300 bg-neutral-50 "
                                                 role="listbox" aria-label="industries list"
                                                 x-on:click.outside="isOpen = false, openedWithKeyboard = false"
                                                 x-on:keydown.down.prevent="$focus.wrap().next()"
                                                 x-on:keydown.up.prevent="$focus.wrap().previous()" x-transition
                                                 x-trap="openedWithKeyboard">

                                                <!-- Search  -->
                                                <div class="relative">
                                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                                                         stroke="currentColor"
                                                         fill="none" stroke-width="1.5"
                                                         class="absolute left-4 top-1/2 size-5 -translate-y-1/2 text-neutral-600/50 "
                                                         aria-hidden="true">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                              d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z"/>
                                                    </svg>
                                                    <input type="text"
                                                           class="w-full border-b borderneutral-300 bg-neutral-50 py-2.5 pl-11 pr-4 text-sm text-neutral-600 focus:outline-none focus-visible:border-black disabled:cursor-not-allowed disabled:opacity-75 "
                                                           name="searchField" aria-label="Search"
                                                           x-on:input="getFilteredOptions($el.value)"
                                                           x-ref="searchField"
                                                           placeholder="Search"/>
                                                </div>

                                                <!-- Options  -->
                                                <ul class="flex max-h-44 flex-col overflow-y-auto">
                                                    <li class="hidden px-4 py-2 text-sm text-neutral-600 "
                                                        x-ref="noResultsMessage">
                                                        <span>No matches found</span>
                                                    </li>
                                                    <template x-for="(item, index) in options" x-bind:key="item.value">
                                                        <li class="combobox-option inline-flex cursor-pointer justify-between gap-6 bg-neutral-50 px-4 py-2 text-sm text-neutral-600 hover:bg-neutral-900/5 hover:text-neutral-900 focus-visible:bg-neutral-900/5 focus-visible:text-neutral-900 focus-visible:outline-none "
                                                            role="option" x-on:click="setSelectedOption(item)"
                                                            x-on:keydown.enter="setSelectedOption(item)"
                                                            x-bind:id="'option-' + index"
                                                            tabindex="0">
                                                            <!-- Label  -->
                                                            <span x-bind:class="selectedOption == item ? 'font-bold' : null"
                                                                  x-text="item.label"></span>
                                                            <!-- Screen reader 'selected' indicator  -->
                                                            <span class="sr-only"
                                                                  x-text="selectedOption == item ? 'selected' : null"></span>
                                                            <!-- Checkmark  -->
                                                            <svg x-cloak x-show="selectedOption == item"
                                                                 xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                                                                 stroke="currentColor" fill="none" stroke-width="2"
                                                                 class="size-4"
                                                                 aria-hidden="true">
                                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                                      d="m4.5 12.75 6 6 9-13.5"></path>
                                                            </svg>
                                                        </li>
                                                    </template>
                                                </ul>
                                            </div>
                                        </div>
                                        <template x-if="errors.specialtie">
                                            <p class="text-red-500 text-xs mt-1" x-text="errors.specialtie[0]"></p>
                                        </template>
                                    </div>

                                    <div class="flex w-full mt-4 flex-col gap-1 text-neutral-600">
                                        <label for="name" class="w-fit pl-0.5 text-sm">Name</label>
                                        <input id="name" type="text"
                                               x-model="formData.name"
                                               class="w-full rounded-md border border-neutral-300 bg-neutral-50 px-2 py-2 text-sm focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-black disabled:cursor-not-allowed disabled:opacity-75 "
                                               name="name" placeholder="Enter doctor name" autocomplete="name"/>
                                        <template x-if="errors.name">
                                            <p class="text-red-500 text-xs mt-1" x-text="errors.name[0]"></p>
                                        </template>
                                    </div>

                                    <div class="flex w-full mt-4 flex-col gap-1 text-neutral-600">
                                        <label for="mobile_number" class="w-fit pl-0.5 text-sm">Mobile Number</label>
                                        <input id="mobile_number" type="mobile_number"
                                               x-model="formData.mobile_number"
                                               class="w-full rounded-md border border-neutral-300 bg-neutral-50 px-2 py-2 text-sm focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-black disabled:cursor-not-allowed disabled:opacity-75 "
                                               name="mobile_number" placeholder="Enter doctor mobile number"
                                               autocomplete="mobile_number"/>
                                        <template x-if="errors.mobile_number">
                                            <p class="text-red-500 text-xs mt-1" x-text="errors.mobile_number[0]"></p>
                                        </template>
                                    </div>

                                    <div class="flex w-full mt-4 flex-col gap-1 text-neutral-600">
                                        <label for="email" class="w-fit pl-0.5 text-sm">Email</label>
                                        <input id="email" type="email"
                                               x-model="formData.email"
                                               class="w-full rounded-md border border-neutral-300 bg-neutral-50 px-2 py-2 text-sm focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-black disabled:cursor-not-allowed disabled:opacity-75 "
                                               name="email" placeholder="Enter doctor email" autocomplete="email"/>
                                        <template x-if="errors.email">
                                            <p class="text-red-500 text-xs mt-1" x-text="errors.email[0]"></p>
                                        </template>
                                    </div>

                                    <div class="flex w-full mt-4 flex-col gap-1 text-neutral-600 mb-8">
                                        <label for="email" class="w-fit pl-0.5 text-sm">Charges (Rs.)</label>
                                        <input id="amount" type="number"
                                               x-model="formData.amount"
                                               class="w-full rounded-md border border-neutral-300 bg-neutral-50 px-2 py-2 text-sm focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-black disabled:cursor-not-allowed disabled:opacity-75 "
                                               name="email" placeholder="Enter doctor charges"/>
                                        <template x-if="errors.amount">
                                            <p class="text-red-500 text-xs mt-1" x-text="errors.amount[0]"></p>
                                        </template>
                                    </div>

                                    <span class="pt-2 font-semibold">Availability</span>

                                    <div class="ml-4" id="weekdays-container" x-init="initializeWeekdays()"></div>
                                </div>
                                <!-- Dialog Footer -->
                                <div class="flex flex-col-reverse justify-between gap-2 border-t border-neutral-300 bg-neutral-50/60 p-4 sm:flex-row sm:items-center md:justify-end">
                                    <button type="submit"
                                            class="flex cursor-pointer items-center justify-center gap-2 whitespace-nowrap bg-black px-4 py-2 text-center text-sm font-medium tracking-wide text-neutral-100 transition hover:opacity-75 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-black active:opacity-100 active:outline-offset-0  rounded-md">
                                        Create
                                    </button>

                                    <button type="reset"
                                            @click="resetFormData()"
                                            class="flex cursor-pointer items-center justify-center gap-2 whitespace-nowrap bg-black px-4 py-2 text-center text-sm font-medium tracking-wide text-neutral-100 transition hover:opacity-75 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-black active:opacity-100 active:outline-offset-0 rounded-md">
                                        Cancel
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <div class="bg-white overflow-hidden w-full overflow-x-auto rounded-md border border-neutral-300 ">
                <table class="w-full text-left text-sm text-neutral-600 ">
                    <thead class="border-b border-neutral-300 bg-neutral-50 text-sm text-neutral-900 ">
                    <tr>
                        <th scope="col" class="p-2">specialty</th>
                        <th scope="col" class="p-2">Name</th>
                        <th scope="col" class="p-2">Email</th>
                        <th scope="col" class="p-2">Mobile Number</th>
                        <th scope="col" class="p-2">Charges (Rs.)</th>
                        <th scope="col" class="p-2"></th>
                    </tr>
                    </thead>
                    <tbody class="divide-y divide-neutral-300 ">
                    <template x-for="item in dataSet" :key="item.id">
                        <tr>
                            <td class="p-4">
                                <span x-text="item.specialty.name"></span>
                            </td>
                            <td class="p-4">
                                <span x-text="item.name"></span>
                            </td>
                            <td class="p-4">
                                <span x-text="item.email"></span>
                            </td>
                            <td class="p-4">
                                <span x-text="item.mobile_number"></span>
                            </td>
                            <td class="p-4">
                                <span x-text="item.amount"></span>
                            </td>
                            <td>
                                <div x-data="{modalIsOpen: false}">
                                    <button type="submit"
                                            @click="modalIsOpen = true"
                                            class="cursor-pointer inline-flex justify-center items-center gap-2 whitespace-nowrap rounded-md bg-green-500 px-2 py-2 text-sm font-medium
                                        tracking-wide text-white transition hover:opacity-75 text-center focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2
                                        focus-visible:outline-red-500 active:opacity-100 active:outline-offset-0 disabled:opacity-75 disabled:cursor-not-allowed"
                                    >
                                        <svg class="feather feather-calendar" fill="none" height="16"
                                             stroke="currentColor"
                                             stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                             viewBox="0 0 24 24" width="24" xmlns="http://www.w3.org/2000/svg">
                                            <rect height="18" rx="2" ry="2" width="18" x="3" y="4"/>
                                            <line x1="16" x2="16" y1="2" y2="6"/>
                                            <line x1="8" x2="8" y1="2" y2="6"/>
                                            <line x1="3" x2="21" y1="10" y2="10"/>
                                        </svg>
                                        Availabilities
                                    </button>

                                    <div x-cloak x-show="modalIsOpen" x-transition.opacity.duration.200ms
                                         x-trap.inert.noscroll="modalIsOpen" @keydown.esc.window="modalIsOpen = false"
                                         @click.self="modalIsOpen = false"
                                         class="fixed inset-0 z-30 flex items-end justify-center bg-black/20 p-4 pb-8 backdrop-blur-md sm:items-center lg:p-8"
                                         role="dialog" aria-modal="true" aria-labelledby="defaultModalTitle">
                                        <!-- Modal Dialog -->
                                        <div x-show="modalIsOpen"
                                             x-transition:enter="transition ease-out duration-200 delay-100 motion-reduce:transition-opacity"
                                             x-transition:enter-start="opacity-0 scale-50"
                                             x-transition:enter-end="opacity-100 scale-100"
                                             class="flex max-w-4xl flex-col gap-1 overflow-hidden rounded-md border border-neutral-300 bg-white text-neutral-600">
                                            <!-- Dialog Header -->
                                            <div class="flex items-center justify-between border-b border-neutral-300 bg-neutral-50/60 p-4">
                                                <h3 id="defaultModalTitle"
                                                    class="font-semibold tracking-wide text-neutral-900">
                                                    Availabilities</h3>
                                                <button @click="modalIsOpen = false" aria-label="close modal">
                                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                                                         aria-hidden="true" stroke="currentColor" fill="none"
                                                         stroke-width="1.4" class="w-5 h-5">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                              d="M6 18L18 6M6 6l12 12"/>
                                                    </svg>
                                                </button>
                                            </div>
                                            <!-- Dialog Body -->
                                            <div class="p-4">
                                                <table class="w-full text-left text-sm text-neutral-600 ">
                                                    <thead class="border-b border-neutral-300 bg-neutral-50 text-sm text-neutral-900">
                                                    <tr>
                                                        <th scope="col" class="p-4">Day</th>
                                                        <th scope="col" class="p-4">Start Time</th>
                                                        <th scope="col" class="p-4">End Time</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody class="divide-y divide-neutral-300">
                                                    <template x-for="item in item.availability" :key="item.id">
                                                        <tr>
                                                            <td class="p-4" x-text="getDayName(item.day)"></td>
                                                            <td class="p-4" x-text="item.start_time"></td>
                                                            <td class="p-4" x-text="item.end_time"></td>
                                                        </tr>
                                                    </template>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div x-data="{modalIsOpen: false}">
                                    <button @click="modalIsOpen = true" type="button"
                                            class="cursor-pointer inline-flex justify-center items-center gap-2 whitespace-nowrap rounded-md bg-amber-500 px-2 py-2 text-sm font-medium tracking-wide text-white transition hover:opacity-75 text-center focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-amber-500 active:opacity-100 active:outline-offset-0 disabled:opacity-75 disabled:cursor-not-allowed dark:bg-amber-500 dark:text-white dark:focus-visible:outline-amber-500">
                                        <svg class="feather feather-edit" fill="none" height="16" stroke="currentColor"
                                             stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                             viewBox="0 0 24 24" width="24" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/>
                                            <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"/>
                                        </svg>
                                        Edit
                                    </button>

                                    <div x-cloak x-show="modalIsOpen" x-transition.opacity.duration.200ms
                                         x-trap.inert.noscroll="modalIsOpen"
                                         @keydown.esc.window="modalIsOpen = false" @click.self="modalIsOpen = false"
                                         class="fixed inset-0 z-30 flex items-end justify-center bg-black/20 p-4 pb-8 backdrop-blur-md sm:items-center lg:p-8"
                                         role="dialog" aria-modal="true" aria-labelledby="defaultModalTitle">
                                        <!-- Modal Dialog -->
                                        <div x-show="modalIsOpen"
                                             x-transition:enter="transition ease-out duration-200 delay-100 motion-reduce:transition-opacity"
                                             x-transition:enter-start="opacity-0 scale-50"
                                             x-transition:enter-end="opacity-100 scale-100"
                                             class="flex w-full max-w-lg flex-col gap-4 overflow-hidden rounded-md border border-neutral-300 bg-white text-neutral-600 ">
                                            <!-- Dialog Header -->
                                            <div class="flex items-center justify-between border-b border-neutral-300 bg-neutral-50/60 p-4">
                                                <h3 id="defaultModalTitle"
                                                    class="font-semibold tracking-wide text-neutral-900">Edit
                                                    Doctor</h3>
                                                <button @click="modalIsOpen = false" aria-label="close modal">
                                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                                                         aria-hidden="true"
                                                         stroke="currentColor" fill="none" stroke-width="1.4"
                                                         class="w-5 h-5">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                              d="M6 18L18 6M6 6l12 12"/>
                                                    </svg>
                                                </button>
                                            </div>
                                            <form method="post" :action="`{{ url('admin/edit-doctor') }}/${item.id}`">
                                                <!-- Dialog Body -->
                                                <div class="px-8 pb-4">
                                                    @method('PATCH')
                                                    @csrf
                                                    <div x-data="{
                                allOptions: {{$speciality}},
                                options: [],
                                isOpen: false,
                                openedWithKeyboard: false,
                                selectedOption: null,
                                setSelectedOption(option) {
                                    this.selectedOption = option
                                    this.isOpen = false
                                    this.openedWithKeyboard = false
                                    this.$refs.hiddenTextField.value = option.id
                                },
                                getFilteredOptions(query) {
                                    this.options = this.allOptions.filter((option) =>
                                        option.label.toLowerCase().includes(query.toLowerCase()),
                                    )
                                    if (this.options.length === 0) {
                                        this.$refs.noResultsMessage.classList.remove('hidden')
                                    } else {
                                        this.$refs.noResultsMessage.classList.add('hidden')
                                    }
                                },
                                init() {
                                    this.options = this.allOptions;
                                    const preselectedId = item.specialty?.id ?? null;

                                    if (preselectedId) {
                                        this.selectedOption = this.allOptions.find(option => option.id == preselectedId);

                                        if (this.selectedOption) {
                                            this.$refs.hiddenTextField.value = this.selectedOption.id;
                                        }
                                    }
                                },
                                openModel() {
                                        modalIsOpen = true
                                },
                                handleKeydownOnOptions(event) {
                                    // if the user presses backspace or the alpha-numeric keys, focus on the search field
                                    if ((event.keyCode >= 65 && event.keyCode <= 90) || (event.keyCode >= 48 && event.keyCode <= 57) || event.keyCode === 8) {
                                        this.$refs.searchField.focus()
                                    }
                                },
                            }"
                                                         class="flex w-full flex-col gap-1"
                                                         x-on:keydown="handleKeydownOnOptions($event)"
                                                         x-on:keydown.esc.window="isOpen = false, openedWithKeyboard = false"
                                                         x-init="options = allOptions">
                                                        <label for="make" x-init="init"
                                                               class="w-fit pl-0.5 text-sm text-neutral-600 ">Speciality</label>
                                                        <div class="relative">

                                                            <!-- trigger button  -->
                                                            <button type="button"
                                                                    class="inline-flex w-full items-center justify-between gap-2 border border-neutral-300 rounded-md bg-neutral-50 px-4 py-2 text-sm font-medium tracking-wide text-neutral-600 transition hover:opacity-75 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-black "
                                                                    role="combobox" aria-controls="makesList"
                                                                    aria-haspopup="listbox"
                                                                    x-on:click="isOpen = ! isOpen"
                                                                    x-on:keydown.down.prevent="openedWithKeyboard = true"
                                                                    x-on:keydown.enter.prevent="openedWithKeyboard = true"
                                                                    x-on:keydown.space.prevent="openedWithKeyboard = true"
                                                                    x-bind:aria-expanded="isOpen || openedWithKeyboard"
                                                                    x-bind:aria-label="selectedOption ? selectedOption.value : 'Please Select'">
                                <span class="text-sm font-normal"
                                      x-text="selectedOption ? selectedOption.value : 'Please Select'"></span>
                                                                <!-- Chevron  -->
                                                                <svg xmlns="http://www.w3.org/2000/svg"
                                                                     viewBox="0 0 20 20"
                                                                     fill="currentColor"
                                                                     class="size-5" aria-hidden="true">
                                                                    <path fill-rule="evenodd"
                                                                          d="M5.22 8.22a.75.75 0 0 1 1.06 0L10 11.94l3.72-3.72a.75.75 0 1 1 1.06 1.06l-4.25 4.25a.75.75 0 0 1-1.06 0L5.22 9.28a.75.75 0 0 1 0-1.06Z"
                                                                          clip-rule="evenodd"/>
                                                                </svg>
                                                            </button>

                                                            <!-- Hidden Input To Grab The Selected Value  -->
                                                            <input id="specialtie" name="specialtie"
                                                                   x-ref="hiddenTextField" hidden=""/>
                                                            <div x-show="isOpen || openedWithKeyboard" id="makesList"
                                                                 class="absolute left-0 top-11 z-10 w-full overflow-hidden rounded-md border border-neutral-300 bg-neutral-50 "
                                                                 role="listbox" aria-label="industries list"
                                                                 x-on:click.outside="isOpen = false, openedWithKeyboard = false"
                                                                 x-on:keydown.down.prevent="$focus.wrap().next()"
                                                                 x-on:keydown.up.prevent="$focus.wrap().previous()"
                                                                 x-transition
                                                                 x-trap="openedWithKeyboard">

                                                                <!-- Search  -->
                                                                <div class="relative">
                                                                    <svg xmlns="http://www.w3.org/2000/svg"
                                                                         viewBox="0 0 24 24"
                                                                         stroke="currentColor"
                                                                         fill="none" stroke-width="1.5"
                                                                         class="absolute left-4 top-1/2 size-5 -translate-y-1/2 text-neutral-600/50 "
                                                                         aria-hidden="true">
                                                                        <path stroke-linecap="round"
                                                                              stroke-linejoin="round"
                                                                              d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z"/>
                                                                    </svg>
                                                                    <input type="text"
                                                                           class="w-full border-b borderneutral-300 bg-neutral-50 py-2.5 pl-11 pr-4 text-sm text-neutral-600 focus:outline-none focus-visible:border-black disabled:cursor-not-allowed disabled:opacity-75 "
                                                                           name="searchField" aria-label="Search"
                                                                           x-on:input="getFilteredOptions($el.value)"
                                                                           x-ref="searchField"
                                                                           placeholder="Search"/>
                                                                </div>

                                                                <!-- Options  -->
                                                                <ul class="flex max-h-44 flex-col overflow-y-auto">
                                                                    <li class="hidden px-4 py-2 text-sm text-neutral-600 "
                                                                        x-ref="noResultsMessage">
                                                                        <span>No matches found</span>
                                                                    </li>
                                                                    <template x-for="(item, index) in options"
                                                                              x-bind:key="item.value">
                                                                        <li class="combobox-option inline-flex cursor-pointer justify-between gap-6 bg-neutral-50 px-4 py-2 text-sm text-neutral-600 hover:bg-neutral-900/5 hover:text-neutral-900 focus-visible:bg-neutral-900/5 focus-visible:text-neutral-900 focus-visible:outline-none "
                                                                            role="option"
                                                                            x-on:click="setSelectedOption(item)"
                                                                            x-on:keydown.enter="setSelectedOption(item)"
                                                                            x-bind:id="'option-' + index"
                                                                            tabindex="0">
                                                                            <!-- Label  -->
                                                                            <span x-bind:class="selectedOption == item ? 'font-bold' : null"
                                                                                  x-text="item.label"></span>
                                                                            <!-- Screen reader 'selected' indicator  -->
                                                                            <span class="sr-only"
                                                                                  x-text="selectedOption == item ? 'selected' : null"></span>
                                                                            <!-- Checkmark  -->
                                                                            <svg x-cloak x-show="selectedOption == item"
                                                                                 xmlns="http://www.w3.org/2000/svg"
                                                                                 viewBox="0 0 24 24"
                                                                                 stroke="currentColor" fill="none"
                                                                                 stroke-width="2"
                                                                                 class="size-4"
                                                                                 aria-hidden="true">
                                                                                <path stroke-linecap="round"
                                                                                      stroke-linejoin="round"
                                                                                      d="m4.5 12.75 6 6 9-13.5">
                                                                            </svg>
                                                                        </li>
                                                                    </template>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="flex w-full mt-4 flex-col gap-1 text-neutral-600">
                                                        <label for="name" class="w-fit pl-0.5 text-sm">Name</label>
                                                        <input id="name" type="text"
                                                               class="w-full rounded-md border border-neutral-300 bg-neutral-50 px-2 py-2 text-sm focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-black disabled:cursor-not-allowed disabled:opacity-75 "
                                                               name="name" placeholder="Enter doctor name"
                                                               autocomplete="name" x-bind:value="item.name"/>
                                                    </div>

                                                    <div class="flex w-full mt-4 flex-col gap-1 text-neutral-600">
                                                        <label for="mobile_number" class="w-fit pl-0.5 text-sm">Mobile
                                                            Number</label>
                                                        <input id="mobile_number" type="mobile_number"
                                                               class="w-full rounded-md border border-neutral-300 bg-neutral-50 px-2 py-2 text-sm focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-black disabled:cursor-not-allowed disabled:opacity-75 "
                                                               name="mobile_number"
                                                               placeholder="Enter doctor mobile number"
                                                               autocomplete="mobile_number"
                                                               x-bind:value="item.mobile_number"/>
                                                    </div>

                                                    <div class="flex w-full mt-4 flex-col gap-1 text-neutral-600">
                                                        <label for="email" class="w-fit pl-0.5 text-sm">Email</label>
                                                        <input id="email" type="email"
                                                               class="w-full rounded-md border border-neutral-300 bg-neutral-50 px-2 py-2 text-sm focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-black disabled:cursor-not-allowed disabled:opacity-75 "
                                                               name="email" placeholder="Enter doctor email"
                                                               autocomplete="email" x-bind:value="item.email"/>
                                                    </div>

                                                    <div class="flex w-full mt-4 flex-col gap-1 text-neutral-600 mb-8">
                                                        <label for="email" class="w-fit pl-0.5 text-sm">Charges (Rs.)</label>
                                                        <input id="amount" type="number"
                                                               class="w-full rounded-md border border-neutral-300 bg-neutral-50 px-2 py-2 text-sm focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-black disabled:cursor-not-allowed disabled:opacity-75 "
                                                               name="amount" placeholder="Enter doctor charges"
                                                                x-bind:value="item.amount"/>
                                                    </div>

                                                    <span class="pt-2 font-semibold">Availability</span>

                                                    <template x-for="day in weekdays" :key="day" class="ml-4">
                                                        <div class="flex items-center justify-between">
                                                            <p class="font-semibold mt-4" x-text="day"></p>
                                                            <div class="flex items-center">
                                                                <div class="inline-flex items-center rounded-md p-2">
                                                                    <select class="px-2 outline-none appearance-none bg-transparent w-16" x-bind:name="'availability[' + day.toLowerCase() + '][start_hour]'">
                                                                        <option value="">H</option>
                                                                        <option value="01" x-bind:selected="matchedAvailability(item.availability, getDayNumber(day))?.start_time.split(':')[0] === '01'">01</option>
                                                                        <option value="02" x-bind:selected="matchedAvailability(item.availability, getDayNumber(day))?.start_time.split(':')[0] === '02'">02</option>
                                                                        <option value="03" x-bind:selected="matchedAvailability(item.availability, getDayNumber(day))?.start_time.split(':')[0] === '03'">03</option>
                                                                        <option value="04" x-bind:selected="matchedAvailability(item.availability, getDayNumber(day))?.start_time.split(':')[0] === '04'">04</option>
                                                                        <option value="05" x-bind:selected="matchedAvailability(item.availability, getDayNumber(day))?.start_time.split(':')[0] === '05'">05</option>
                                                                        <option value="06" x-bind:selected="matchedAvailability(item.availability, getDayNumber(day))?.start_time.split(':')[0] === '06'">06</option>
                                                                        <option value="07" x-bind:selected="matchedAvailability(item.availability, getDayNumber(day))?.start_time.split(':')[0] === '07'">07</option>
                                                                        <option value="08" x-bind:selected="matchedAvailability(item.availability, getDayNumber(day))?.start_time.split(':')[0] === '08'">08</option>
                                                                        <option value="09" x-bind:selected="matchedAvailability(item.availability, getDayNumber(day))?.start_time.split(':')[0] === '09'">09</option>
                                                                        <option value="10" x-bind:selected="matchedAvailability(item.availability, getDayNumber(day))?.start_time.split(':')[0] === '10'">10</option>
                                                                        <option value="11" x-bind:selected="matchedAvailability(item.availability, getDayNumber(day))?.start_time.split(':')[0] === '11'">11</option>
                                                                        <option value="12" x-bind:selected="matchedAvailability(item.availability, getDayNumber(day))?.start_time.split(':')[0] === '12'">12</option>
                                                                    </select>
                                                                    <span class="px-2">:</span>
                                                                    <select  class="px-2 outline-none appearance-none bg-transparent w-16 mr-2"  x-bind:name="'availability[' + day.toLowerCase() + '][start_minute]'">
                                                                        <option value="">M</option>
                                                                        <option value="00" x-bind:selected="matchedAvailability(item.availability, getDayNumber(day))?.start_time.split(':')[1] === '00'">00</option>
                                                                        <option value="15" x-bind:selected="matchedAvailability(item.availability, getDayNumber(day))?.start_time.split(':')[1] === '15'">15</option>
                                                                        <option value="30" x-bind:selected="matchedAvailability(item.availability, getDayNumber(day))?.start_time.split(':')[1] === '30'">30</option>
                                                                        <option value="45" x-bind:selected="matchedAvailability(item.availability, getDayNumber(day))?.start_time.split(':')[1] === '45'">45</option>
                                                                    </select>
                                                                </div>
                                                            <p>-</p>
                                                            <div class="inline-flex items-center rounded-md p-2">
                                                                <select class="px-2 outline-none appearance-none bg-transparent w-16" x-bind:name="'availability[' + day.toLowerCase() + '][end_hour]'">
                                                                    <option value="">H</option>
                                                                    <option value="01" x-bind:selected="matchedAvailability(item.availability, getDayNumber(day))?.end_time.split(':')[0] === '01'">01</option>
                                                                    <option value="02" x-bind:selected="matchedAvailability(item.availability, getDayNumber(day))?.end_time.split(':')[0] === '02'">02</option>
                                                                    <option value="03" x-bind:selected="matchedAvailability(item.availability, getDayNumber(day))?.end_time.split(':')[0] === '03'">03</option>
                                                                    <option value="04" x-bind:selected="matchedAvailability(item.availability, getDayNumber(day))?.end_time.split(':')[0] === '04'">04</option>
                                                                    <option value="05" x-bind:selected="matchedAvailability(item.availability, getDayNumber(day))?.end_time.split(':')[0] === '05'">05</option>
                                                                    <option value="06" x-bind:selected="matchedAvailability(item.availability, getDayNumber(day))?.end_time.split(':')[0] === '06'">06</option>
                                                                    <option value="07" x-bind:selected="matchedAvailability(item.availability, getDayNumber(day))?.end_time.split(':')[0] === '07'">07</option>
                                                                    <option value="08" x-bind:selected="matchedAvailability(item.availability, getDayNumber(day))?.end_time.split(':')[0] === '08'">08</option>
                                                                    <option value="09" x-bind:selected="matchedAvailability(item.availability, getDayNumber(day))?.end_time.split(':')[0] === '09'">09</option>
                                                                    <option value="10" x-bind:selected="matchedAvailability(item.availability, getDayNumber(day))?.end_time.split(':')[0] === '10'">10</option>
                                                                    <option value="11" x-bind:selected="matchedAvailability(item.availability, getDayNumber(day))?.end_time.split(':')[0] === '11'">11</option>
                                                                    <option value="12" x-bind:selected="matchedAvailability(item.availability, getDayNumber(day))?.end_time.split(':')[0] === '12'">12</option>
                                                                </select>
                                                                <span class="px-2">:</span>
                                                                <select  class="px-2 outline-none appearance-none bg-transparent w-16 mr-2" x-bind:name="'availability[' + day.toLowerCase() + '][end_minute]'">\
                                                                    <option value="">M</option>
                                                                    <option value="00" x-bind:selected="matchedAvailability(item.availability, getDayNumber(day))?.end_time.split(':')[1] === '00'">00</option>
                                                                    <option value="15" x-bind:selected="matchedAvailability(item.availability, getDayNumber(day))?.end_time.split(':')[1] === '15'">15</option>
                                                                    <option value="30" x-bind:selected="matchedAvailability(item.availability, getDayNumber(day))?.end_time.split(':')[1] === '30'">30</option>
                                                                    <option value="45" x-bind:selected="matchedAvailability(item.availability, getDayNumber(day))?.end_time.split(':')[1] === '45'">45</option>
                                                                </select>
                                                            </div>
                                                            </div>
                                                        </div>
                                                    </template>
                                                </div>
                                                <!-- Dialog Footer -->
                                                <div class="flex flex-col-reverse justify-between gap-2 border-t border-neutral-300 bg-neutral-50/60 p-4 sm:flex-row sm:items-center md:justify-end">
                                                    <button type="submit"
                                                            class="flex cursor-pointer items-center justify-center gap-2 whitespace-nowrap bg-black px-4 py-2 text-center text-sm font-medium tracking-wide text-neutral-100 transition hover:opacity-75 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-black active:opacity-100 active:outline-offset-0  rounded-md">
                                                        Update
                                                    </button>

                                                    <button type="reset"
                                                            class="flex cursor-pointer items-center justify-center gap-2 whitespace-nowrap bg-black px-4 py-2 text-center text-sm font-medium tracking-wide text-neutral-100 transition hover:opacity-75 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-black active:opacity-100 active:outline-offset-0 rounded-md">
                                                        Cancel
                                                    </button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <form method="POST" :action="`{{ url('admin/delete-doctor') }}/${item.id}`">
                                    @method('DELETE')
                                    @csrf
                                    <button type="submit"
                                            class="cursor-pointer inline-flex justify-center items-center gap-2 whitespace-nowrap rounded-md bg-red-500 px-2 py-2 text-sm font-medium tracking-wide text-white transition hover:opacity-75 text-center focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-red-500 active:opacity-100 active:outline-offset-0 disabled:opacity-75 disabled:cursor-not-allowed">
                                        <svg class="feather feather-trash" fill="none" height="16" stroke="currentColor"
                                             stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                             viewBox="0 0 24 24" width="16" xmlns="http://www.w3.org/2000/svg">
                                            <polyline points="3 6 5 6 21 6"/>
                                            <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"/>
                                        </svg>
                                        Delete
                                    </button>
                                </form>
                            </td>
                        </tr>
                    </template>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script>
        function getDoctors() {
            return {
                dataSet: [],
                weekdays:["Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday", "Sunday"],
                minutes: ['00', '15', '30', '45'],
                get() {
                    axios.get('{{ route('admin.get-doctor') }}')
                        .then(response => {
                            this.dataSet = response.data;
                        })
                        .catch(error => {
                            console.error(error);
                        });
                },
                generateDayRow(day) {
                    const container = document.createElement('div');
                    container.id = `day-${day.toLowerCase()}`;
                    container.className = 'flex items-center justify-between py-2';

                    const dayHTML = `
                    <p class="font-semibold">${day}</p>
                    <div class="flex items-center">
                        <!-- Start Time -->
                        <div class="inline-flex items-center rounded-md p-2">
                            <select x-model="formData.availability.${day.toLowerCase()}.start_hour" class="px-2 outline-none appearance-none bg-transparent w-16">
                                ${Array.from({length: 12}, (_, i) => {
                        const hour = String(i + 1).padStart(2, '0');
                        return `<option value="${hour}">${hour}</option>`;
                    }).join('')}
                            </select>
                            <span class="px-2">:</span>
                            <select x-model="formData.availability.${day.toLowerCase()}.start_minute" class="px-2 outline-none appearance-none bg-transparent w-16 mr-2">
                                ${this.minutes.map(minute => `<option value="${minute}">${minute}</option>`).join('')}
                            </select>
                        </div>
                        <p>-</p>
                        <!-- End Time -->
                        <div class="inline-flex items-center rounded-md p-2">
                            <select x-model="formData.availability.${day.toLowerCase()}.end_hour" class="px-2 outline-none appearance-none bg-transparent w-16">
                                ${Array.from({length: 12}, (_, i) => {
                        const hour = String(i + 1).padStart(2, '0');
                        return `<option value="${hour}">${hour}</option>`;
                    }).join('')}
                            </select>
                            <span class="px-2">:</span>
                            <select x-model="formData.availability.${day.toLowerCase()}.end_minute" class="px-2 outline-none appearance-none bg-transparent w-16">
                                ${this.minutes.map(minute => `<option value="${minute}">${minute}</option>`).join('')}
                            </select>
                        </div>
                        <button @click="removeDay('${day.toLowerCase()}')" type="button"
                            class="text-white cursor-pointer whitespace-nowrap rounded-md bg-red-500 px-4 py-2 text-xs font-medium tracking-wide text-white
                            transition hover:opacity-75 text-center focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-red-500
                            active:opacity-100 active:outline-offset-0 disabled:opacity-75 disabled:cursor-not-allowed dark:bg-red-500 dark:text-white
                            dark:focus-visible:outline-red-500">
                            X
                        </button>
                    </div>
                `;

                    container.innerHTML = dayHTML;
                    return container;
                },
                matchedAvailability(availability, dayIndex) {
                    return availability.find(item => item.day === dayIndex) || null;
                },
            }
        }

        function formModel() {
            return {
                modalIsOpen: false,
                formData: {
                    specialtie: '',
                    name: '',
                    email: '',
                    mobile_number: '',
                    amount: 0,
                    availability: {
                        monday: {start_hour: '', start_minute: '', end_hour: '', end_minute: ''},
                        tuesday: {start_hour: '', start_minute: '', end_hour: '', end_minute: ''},
                        wednesday: {start_hour: '', start_minute: '', end_hour: '', end_minute: ''},
                        thursday: {start_hour: '', start_minute: '', end_hour: '', end_minute: ''},
                        friday: {start_hour: '', start_minute: '', end_hour: '', end_minute: ''},
                        saturday: {start_hour: '', start_minute: '', end_hour: '', end_minute: ''},
                        sunday: {start_hour: '', start_minute: '', end_hour: '', end_minute: ''}
                    }
                },
                isLoading: false,
                errors: {},
                allOptions: @json($speciality),
                options: [],
                isOpen: false,
                openedWithKeyboard: false,
                selectedOption: null,
                hiddenRows: [],
                resetFormData() {
                    this.formData = {
                        specialtie: '',
                        name: '',
                        email: '',
                        mobile_number: '',
                        amount: 0,
                        availability: {
                            monday: {start_hour: '', start_minute: '', end_hour: '', end_minute: ''},
                            tuesday: {start_hour: '', start_minute: '', end_hour: '', end_minute: ''},
                            wednesday: {start_hour: '', start_minute: '', end_hour: '', end_minute: ''},
                            thursday: {start_hour: '', start_minute: '', end_hour: '', end_minute: ''},
                            friday: {start_hour: '', start_minute: '', end_hour: '', end_minute: ''},
                            saturday: {start_hour: '', start_minute: '', end_hour: '', end_minute: ''},
                            sunday: {start_hour: '', start_minute: '', end_hour: '', end_minute: ''}
                        }
                    };
                    this.selectedOption = null;
                    this.get();
                    this.resetDays();
                    this.errors = {};
                },
                submitForm() {
                    this.isLoading = true;
                    axios.post('{{ route('admin.store-doctor') }}', this.formData)
                        .then(response => {
                            Swal.fire({
                                position: "top-end",
                                icon: "success",
                                title: "Doctor created successfully!",
                                showConfirmButton: false,
                                timer: 1500
                            });
                            this.isLoading = false;
                            this.close();
                            this.resetFormData();
                        })
                        .catch(error => {
                            this.isLoading = false;
                            if (error.response && error.response.status === 422) {
                                // Validation errors
                                this.errors = error.response.data.errors;
                            } else {
                                Swal.fire({
                                    title: 'Error!',
                                    text: 'An unexpected error occurred. Please try again.',
                                    icon: 'error',
                                    confirmButtonText: 'Ok'
                                })
                                this.close();
                                this.resetFormData();
                            }
                        });
                },
                open() {
                    this.modalIsOpen = true;
                    this.$nextTick(() => {
                        this.resetFormData();
                    });
                },
                close() {
                    this.modalIsOpen = false
                    this.errors = {}
                },
                setSelectedOption(option)  {
                    this.selectedOption = option
                    this.isOpen = false
                    this.openedWithKeyboard = false
                    this.$refs.hiddenTextField.value = option.id
                    this.formData.specialtie = option.id;
                },
                getFilteredOptions(query) {
                    this.options = this.allOptions.filter((option) =>
                        option.label.toLowerCase().includes(query.toLowerCase()),
                    )
                    if (this.options.length === 0) {
                        this.$refs.noResultsMessage.classList.remove('hidden')
                    } else {
                        this.$refs.noResultsMessage.classList.add('hidden')
                    }
                },
                handleKeydownOnOptions(event) {
                    // if the user presses backspace or the alpha-numeric keys, focus on the search field
                    if ((event.keyCode >= 65 && event.keyCode <= 90) || (event.keyCode >= 48 && event.keyCode <= 57) || event.keyCode === 8) {
                        this.$refs.searchField.focus()
                    }
                },
                initializeWeekdays() {
                    this.weekdays.forEach(day => {
                        this.formData.availability[day.toLowerCase()] = {
                            start_hour: '',
                            start_minute: '',
                            end_hour: '',
                            end_minute: ''
                        };

                        const dayRow = this.generateDayRow(day);
                        document.getElementById('weekdays-container').appendChild(dayRow);
                    });
                },
                removeDay(day) {
                    const dayRow = document.getElementById(`day-${day}`);
                    if (dayRow) {
                        dayRow.style.display = 'none'; // Hide the row
                        this.hiddenRows.push(day); // Track hidden row
                        this.formData.availability[day] = {
                            start_hour: '',
                            start_minute: '',
                            end_hour: '',
                            end_minute: ''
                        };
                    }
                },
                resetDays() {
                    // Show all hidden rows
                    this.hiddenRows.forEach(day => {
                        const dayRow = document.getElementById(`day-${day}`);
                        if (dayRow) {
                            dayRow.style.display = 'flex'; // Restore visibility
                            this.formData.availability[day] = {
                                start_hour: '',
                                start_minute: '',
                                end_hour: '',
                                end_minute: ''
                            };
                        }
                    });
                    this.hiddenRows = []; // Clear hidden rows tracker
                },
            }
        }

        function removeDay(day) {
            const dayRow = document.getElementById(`day-${day}`);
            if (dayRow) {
                // Hide the row
                dayRow.style.display = 'none';
                this.formData.availability[day] = {
                    start_hour: '',
                    start_minute: '',
                    end_hour: '',
                    end_minute: ''
                };

                // Reset the input values to prevent submission
                const inputs = dayRow.querySelectorAll('select');
                inputs.forEach(input => {
                    input.value = '';
                });
            }
        }

        function getDayName(dayNumber) {
            const days = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday','Sunday',];
            return days[dayNumber-1] || 'Invalid day number';
        }

        function getDayNumber(dayName) {
            const days = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'];
            const index = days.indexOf(dayName)+1;
            return index !== -1 ? index : null;
        }

    </script>
</x-guest-layout>