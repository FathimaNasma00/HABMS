<x-guest-layout>
    <div class="mx-auto sm:px-6 lg:px-8">
        <div class="w-full" x-data="getAppointment()" x-init="get()">

            @if (session('success'))
                <div x-data="{ alertIsVisible: true }" x-show="alertIsVisible"
                     class="relative w-full overflow-hidden rounded-none border border-green-600 bg-white text-slate-700 mb-4"
                     role="alert" x-transition:leave="transition ease-in duration-300"
                     x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-90">
                    <div class="flex w-full items-center gap-2 bg-green-600/10 p-4">
                        <div class="bg-green-600/15 text-green-600 rounded-full p-1" aria-hidden="true">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"
                                 class="size-6" aria-hidden="true">
                                <path fill-rule="evenodd"
                                      d="M10 18a8 8 0 1 0 0-16 8 8 0 0 0 0 16Zm3.857-9.809a.75.75 0 0 0-1.214-.882l-3.483 4.79-1.88-1.88a.75.75 0 1 0-1.06 1.061l2.5 2.5a.75.75 0 0 0 1.137-.089l4-5.5Z"
                                      clip-rule="evenodd"/>
                            </svg>
                        </div>
                        <div class="ml-2">
                            <h3 class="text-sm font-semibold text-green-600">Successfully</h3>
                            <p class="text-xs font-medium sm:text-sm">{{ session('success') }}</p>
                        </div>
                        <button type="button" @click="alertIsVisible = false" class="ml-auto"
                                aria-label="dismiss alert">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" aria-hidden="true"
                                 stroke="currentColor" fill="none" stroke-width="2.5" class="w-4 h-4 shrink-0">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/>
                            </svg>
                        </button>
                    </div>
                </div>
            @endif
            @if (session('error'))
                <div x-data="{ alertIsVisible: true }" x-show="alertIsVisible"
                     class="relative w-full overflow-hidden rounded-none border border-red-600 bg-white text-slate-700 mb-4"
                     role="alert" x-transition:leave="transition ease-in duration-300"
                     x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-90">
                    <div class="flex w-full items-center gap-2 bg-red-600/10 p-4">
                        <div class="bg-red-600/15 text-red-600 rounded-full p-1" aria-hidden="true">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"
                                 class="size-6" aria-hidden="true">
                                <path fill-rule="evenodd"
                                      d="M10 18a8 8 0 1 0 0-16 8 8 0 0 0 0 16ZM8.28 7.22a.75.75 0 0 0-1.06 1.06L8.94 10l-1.72 1.72a.75.75 0 1 0 1.06 1.06L10 11.06l1.72 1.72a.75.75 0 1 0 1.06-1.06L11.06 10l1.72-1.72a.75.75 0 0 0-1.06-1.06L10 8.94 8.28 7.22Z"
                                      clip-rule="evenodd"/>
                            </svg>
                        </div>
                        <div class="ml-2">
                            <h3 class="text-sm font-semibold text-red-600">Error</h3>
                            <p class="text-xs font-medium sm:text-sm">{{ session('error') }}</p>
                        </div>
                        <button type="button" @click="alertIsVisible = false" class="ml-auto"
                                aria-label="dismiss alert">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" aria-hidden="true"
                                 stroke="currentColor" fill="none" stroke-width="2.5" class="w-4 h-4 shrink-0">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/>
                            </svg>
                        </button>
                    </div>
                </div>
            @endif
            <div class="flex justify-between">
                <p class="mb-6 text-lg font-semibold">My Appointments</p>
                <div x-data="formModel()">
                    <button @click="open()" type="button"
                            class="cursor-pointer  px-4 py-2 text-sm font-bold text-white rounded-[30px] border-2 border-white bg-gradient-to-r from-blue-400
               to-green-400 hover:from-blue-500 hover:to-green-500 focus:outline-none focus:ring-2 focus:ring-blue-400 focus:ring-offset-1">
                        Create Appointment
                    </button>
                    <div x-cloak
                         x-show="modalIsOpen"
                         x-transition.opacity.duration.200ms
                         x-trap.inert.noscroll="modalIsOpen"
                         @keydown.esc.window="modalIsOpen = false"
                         @click.self="modalIsOpen = false"
                         class="fixed inset-0 z-30 flex items-end justify-center bg-black/20 p-4 pb-8 backdrop-blur-md sm:items-center lg:p-8"
                         role="dialog"
                         aria-modal="true"
                         aria-labelledby="defaultModalTitle">
                        <!-- Modal Dialog -->
                        <div x-show="modalIsOpen"
                             x-transition:enter="transition ease-out duration-200 delay-100 motion-reduce:transition-opacity"
                             x-transition:enter-start="opacity-0 scale-50"
                             x-transition:enter-end="opacity-100 scale-100"
                             class="flex w-full max-w-lg flex-col gap-4 overflow-hidden rounded-md border border-neutral-300 bg-white text-neutral-600 ">
                            <!-- Dialog Header -->
                            <div class="flex items-center justify-between border-b border-neutral-300 bg-neutral-50/60 p-4">
                                <h3 id="defaultModalTitle"
                                    class="font-semibold tracking-wide text-neutral-900"
                                >Create
                                    Appointment</h3>
                                <button @click="modalIsOpen = false"
                                        aria-label="close modal"
                                >
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
                                    <div x-cloak="" x-data="app()" x-init="[initDate(), getNoOfDays()]">
                                        <div>
                                            <label for="make"
                                                   class="w-fit pl-0.5 text-sm text-neutral-600">Date</label>
                                            <div class="flex items-center space-x-4">
                                                <div class="relative w-full">
                                                    <input name="date" type="hidden" x-ref="date"
                                                           x-model="formData.date"/>
                                                    <input type="text" readonly
                                                           x-model="datepickerValue"
                                                           @click="showPicker()"
                                                           @keydown.escape="showDatepicker = false"
                                                           class="w-full pl-4 pr-10 py-2 leading-none rounded-lg shadow-sm focus:outline-none focus:shadow-outline text-gray-600 font-sm"
                                                           placeholder="Select date">
                                                    <div class="absolute top-0 right-0 px-3 py-2">
                                                        <svg class="h-6 w-6 text-gray-400" fill="none"
                                                             stroke="currentColor"
                                                             viewbox="0 0 24 24">
                                                            <path d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"
                                                                  stroke-linecap="round" stroke-linejoin="round"
                                                                  stroke-width="2"></path>
                                                        </svg>
                                                    </div>
                                                    <div class="bg-white mt-12 rounded-lg shadow p-4 absolute top-0 z-50 left-0"
                                                         style="width: 17rem"
                                                         x-show.transition="showDatepicker"
                                                         @click.away="showDatepicker = false">
                                                        <div class="flex justify-between items-center mb-2">
                                                            <div>
                                                            <span class="text-lg font-bold text-gray-800"
                                                                  x-text="MONTH_NAMES[month]"></span>
                                                                <span class="ml-1 text-lg text-gray-600 font-normal"
                                                                      x-text="year"></span>
                                                            </div>
                                                            <div>
                                                                <button type="button"
                                                                        class="transition ease-in-out duration-100 inline-flex cursor-pointer hover:bg-gray-200 p-1 rounded-full"
                                                                        :class="{'cursor-not-allowed opacity-25': month == 0 }"
                                                                        :disabled="month == 0 ? true : false"
                                                                        @click="month--; getNoOfDays()">
                                                                    <svg class="h-6 w-6 text-gray-500 inline-flex"
                                                                         fill="none"
                                                                         stroke="currentColor" viewbox="0 0 24 24">
                                                                        <path d="M15 19l-7-7 7-7" stroke-linecap="round"
                                                                              stroke-linejoin="round"
                                                                              stroke-width="2"></path>
                                                                    </svg>
                                                                    <button type="button"
                                                                            class="transition ease-in-out duration-100 inline-flex cursor-pointer hover:bg-gray-200 p-1 rounded-full"
                                                                            :class="{'cursor-not-allowed opacity-25': month == 11 }"
                                                                            :disabled="month == 11 ? true : false"
                                                                            @click="month++; getNoOfDays()">
                                                                        <svg class="h-6 w-6 text-gray-500 inline-flex"
                                                                             fill="none"
                                                                             stroke="currentColor" viewbox="0 0 24 24">
                                                                            <path d="M9 5l7 7-7 7"
                                                                                  stroke-linecap="round"
                                                                                  stroke-linejoin="round"
                                                                                  stroke-width="2"></path>
                                                                        </svg>
                                                                    </button>
                                                                </button>
                                                            </div>
                                                        </div>
                                                        <div class="flex flex-wrap mb-3 -mx-1">
                                                            <template :key="index" x-for="(day, index) in DAYS">
                                                                <div class="px-1" style="width: 14.26%">
                                                                    <div class="text-gray-800 font-medium text-center text-xs"
                                                                         x-text="day"></div>
                                                                </div>
                                                            </template>
                                                        </div>
                                                        <div class="flex flex-wrap -mx-1">
                                                            <template x-for="blankday in blankdays">
                                                                <div class="text-center border p-1 border-transparent text-sm"
                                                                     style="width: 14.28%"></div>
                                                            </template>
                                                            <template :key="dateIndex"
                                                                      x-for="(date, dateIndex) in no_of_days">
                                                                <div class="px-1 mb-1" style="width: 14.28%">
                                                                    <div @click="getDateValue(date)" x-text="date"
                                                                         class="cursor-pointer text-center text-sm leading-none rounded-full leading-loose transition ease-in-out duration-100"
                                                                         :class="{'bg-blue-500 text-white': isToday(date) == true, 'text-gray-700 hover:bg-blue-200': isToday(date) == false }">
                                                                    </div>
                                                                </div>
                                                            </template>
                                                        </div>
                                                    </div>
                                                </div>
                                                <a x-show="isDisable" href="{{route('home.find-doc')}}" type="button"
                                                   class="cursor-pointer whitespace-nowrap rounded-none bg-slate-100 px-4 py-2 text-xs
                                                        font-medium tracking-wide text-black transition hover:opacity-75 text-center focus-visible:outline
                                                        focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-slate-100 active:opacity-100
                                                        active:outline-offset-0 disabled:opacity-75 disabled:cursor-not-allowed ">
                                                    Change
                                                </a>

                                            </div>
                                            <template x-if="errors.date">
                                                <p class="text-red-500 text-xs mt-1" x-text="errors.date[0]"></p>
                                            </template>
                                        </div>

                                        <div id="doctor-select"
                                             class="flex w-full flex-col gap-1 mt-4"
                                             x-on:keydown="handleKeydownOnOptions($event)"
                                             x-on:keydown.esc.window="isOpen = false, openedWithKeyboard = false"
                                             x-init="init()"
                                             x-data="doctorSelectComponent">
                                            <label for="make"
                                                   class="w-fit pl-0.5 text-sm text-neutral-600 ">Doctor</label>
                                            <div class="relative">
                                                <!-- trigger button  -->
                                                <button type="button"
                                                        class="inline-flex w-full items-center justify-between gap-2 border border-neutral-300 rounded-md bg-neutral-50 px-4 py-2 text-sm font-medium tracking-wide text-neutral-600 transition hover:opacity-75 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-black "
                                                        role="combobox"
                                                        aria-controls="makesList"
                                                        aria-haspopup="listbox"
                                                        x-on:click="isOpen = ! isOpen"
                                                        x-on:keydown.down.prevent="openedWithKeyboard = true"
                                                        x-on:keydown.enter.prevent="openedWithKeyboard = true"
                                                        x-on:keydown.space.prevent="openedWithKeyboard = true"
                                                        x-bind:aria-expanded="isOpen || openedWithKeyboard"
                                                        x-bind:aria-label="selectedOption ? selectedOption.value : 'Please Select'">
                                            <span class="text-sm font-normal"
                                                  x-text="selectedOption ? selectedOption.value : 'Please Select'">
                                            </span>
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
                                                <input id="doctor" name="doctor" x-ref="hiddenTextField" hidden=""
                                                       x-model="formData.doctor"/>
                                                <div x-show="isOpen || openedWithKeyboard" id="makesList"
                                                     class="absolute left-0 top-11 z-10 w-full overflow-hidden rounded-md border border-neutral-300 bg-neutral-50 "
                                                     role="listbox"
                                                     aria-label="industries list"
                                                     x-on:click.outside="isOpen = false, openedWithKeyboard = false"
                                                     x-on:keydown.down.prevent="$focus.wrap().next()"
                                                     x-on:keydown.up.prevent="$focus.wrap().previous()" x-transition
                                                     x-trap="openedWithKeyboard"
                                                >

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

                                            <template x-if="errors.doctor">
                                                <p class="text-red-500 text-xs mt-1" x-text="errors.doctor[0]"></p>
                                            </template>
                                        </div>

                                        <div class="flex w-full mt-4 flex-col gap-1 text-neutral-600">
                                            <label for="name" class="w-fit pl-0.5 text-sm">Appointment for</label>
                                            <div class="flex items-center justify-start gap-2 font-medium text-neutral-600 has-[:disabled]:opacity-75">
                                                <input id="radioMac" type="radio" class="before:content[''] relative h-4 w-4 appearance-none rounded-full border
                                                border-neutral-300 bg-neutral-50 before:invisible before:absolute before:left-1/2 before:top-1/2 before:h-1.5 before:w-1.5
                                                before:-translate-x-1/2 before:-translate-y-1/2 before:rounded-full before:bg-neutral-100 checked:border-black checked:bg-black
                                                checked:before:visible focus:outline focus:outline-2 focus:outline-offset-2 focus:outline-neutral-800 checked:focus:outline-black
                                                disabled:cursor-not-allowed " name="is_other" value="false"
                                                       x-model="formData.is_other"
                                                       :checked="!formData.is_other"
                                                >
                                                <label for="radioMac" class="text-sm">Me</label>
                                            </div>
                                            <div class="flex items-center justify-start gap-2 font-medium text-neutral-600 has-[:disabled]:opacity-75">
                                                <input id="radioWindows" type="radio" class="before:content[''] relative h-4 w-4 appearance-none rounded-full border
                                                border-neutral-300 bg-neutral-50 before:invisible before:absolute before:left-1/2 before:top-1/2 before:h-1.5 before:w-1.5
                                                before:-translate-x-1/2 before:-translate-y-1/2 before:rounded-full before:bg-neutral-100 checked:border-black checked:bg-black
                                                checked:before:visible focus:outline focus:outline-2 focus:outline-offset-2 focus:outline-neutral-800 checked:focus:outline-black
                                                disabled:cursor-not-allowed " name="is_other" value="true"
                                                       x-model="formData.is_other"
                                                       :checked="formData.is_other"
                                                >
                                                <label for="radioWindows" class="text-sm">Another Patient</label>
                                            </div>
                                        </div>

                                        <div x-show="formData.is_other === 'true'" x-transition>
                                            <div class="flex w-full mt-4 flex-col gap-1 text-neutral-600">
                                                <label for="name" class="w-fit pl-0.5 text-sm">Patient Name</label>
                                                <input id="name" type="text"
                                                       class="w-full rounded-md border border-neutral-300 bg-neutral-50 px-2 py-2 text-sm focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-black disabled:cursor-not-allowed disabled:opacity-75 "
                                                       name="name" placeholder="Enter Patient Name" autocomplete="name"
                                                       x-model="formData.name"/>
                                                <template x-if="errors.name">
                                                    <p class="text-red-500 text-xs mt-1" x-text="errors.name[0]"></p>
                                                </template>
                                            </div>

                                            <div class="flex w-full mt-4 flex-col gap-1 text-neutral-600">
                                                <label for="name" class="w-fit pl-0.5 text-sm">Patient Email</label>
                                                <input id="name" type="text"
                                                       class="w-full rounded-md border border-neutral-300 bg-neutral-50 px-2 py-2 text-sm focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-black disabled:cursor-not-allowed disabled:opacity-75 "
                                                       name="email" placeholder="Enter Patient Email"
                                                       autocomplete="email"
                                                       x-model="formData.email"/>
                                                <template x-if="errors.email">
                                                    <p class="text-red-500 text-xs mt-1" x-text="errors.email[0]"></p>
                                                </template>
                                            </div>

                                            <div class="flex w-full mt-4 flex-col gap-1 text-neutral-600">
                                                <label for="age" class="w-fit pl-0.5 text-sm">Patient Age</label>
                                                <input id="age" type="number"
                                                       class="w-full rounded-md border border-neutral-300 bg-neutral-50 px-2 py-2 text-sm focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-black disabled:cursor-not-allowed disabled:opacity-75 "
                                                       name="age" placeholder="Enter Patient Age" autocomplete="age"
                                                       x-model="formData.age"/>
                                                <template x-if="errors.age">
                                                    <p class="text-red-500 text-xs mt-1" x-text="errors.age[0]"></p>
                                                </template>
                                            </div>

                                            <div class="flex w-full mt-4 flex-col gap-1 text-neutral-600">
                                                <label for="mobile" class="w-fit pl-0.5 text-sm">Patient Mobile
                                                    Number</label>
                                                <input id="mobile"
                                                       type="tel"
                                                       class="w-full rounded-md border border-neutral-300 bg-neutral-50 px-2 py-2 text-sm focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-black disabled:cursor-not-allowed disabled:opacity-75"
                                                       name="mobile"
                                                       placeholder="e.g., 07xxxxxxxx"
                                                       autocomplete="mobile"
                                                       maxlength="10"
                                                       x-model="formData.mobile"
                                                />
                                                <template x-if="errors.mobile">
                                                    <p class="text-red-500 text-xs mt-1" x-text="errors.mobile[0]"></p>
                                                </template>
                                            </div>
                                        </div>

                                    </div>
                                    <!-- Dialog Footer -->
                                    <div class="flex flex-col-reverse justify-between gap-2 border-t border-neutral-300 bg-neutral-50/60 pt-4 sm:flex-row sm:items-center md:justify-end">
                                        <button type="submit" :disabled="isLoading"
                                                class="inline-flex items-center gap-2 whitespace-nowrap rounded-md bg-black px-4 py-2 text-sm font-medium tracking-wide text-neutral-100 transition hover:opacity-75 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-black active:opacity-100 active:outline-offset-0 disabled:opacity-75 disabled:cursor-not-allowed">
                                            <svg x-show="isLoading" aria-hidden="true"
                                                 xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                                                 class="size-5 animate-spin motion-reduce:animate-none fill-neutral-100">
                                                <path opacity="0.25"
                                                      d="M12,1A11,11,0,1,0,23,12,11,11,0,0,0,12,1Zm0,19a8,8,0,1,1,8-8A8,8,0,0,1,12,20Z"/>
                                                <path d="M10.14,1.16a11,11,0,0,0-9,8.92A1.59,1.59,0,0,0,2.46,12,1.52,1.52,0,0,0,4.11,10.7a8,8,0,0,1,6.66-6.61A1.42,1.42,0,0,0,12,2.69h0A1.57,1.57,0,0,0,10.14,1.16Z"/>
                                            </svg>
                                            Create
                                        </button>

                                        <button type="reset" @click="close()"
                                                class="flex cursor-pointer items-center justify-center gap-2 whitespace-nowrap bg-black px-4 py-2 text-center text-sm font-medium tracking-wide text-neutral-100 transition hover:opacity-75 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-black active:opacity-100 active:outline-offset-0 rounded-md">
                                            Cancel
                                        </button>
                                    </div>
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
                        <th scope="col" class="p-2">Doctor</th>
                        <th scope="col" class="p-2">Patient Name</th>
                        <th scope="col" class="p-2">Patient Email</th>
                        <th scope="col" class="p-2">Age</th>
                        <th scope="col" class="p-2">Mobile No</th>
                        <th scope="col" class="p-2">Amount (Rs.)</th>
                        <th scope="col" class="p-2">Date</th>
                        <th scope="col" class="p-2">Time</th>
                        <th scope="col" class="p-2">Status</th>
                    </tr>
                    </thead>
                    <tbody class="divide-y divide-neutral-300 ">
                    <template x-for="item in dataSet" :key="item.id">
                        <tr>
                            <td class="p-4">
                                <span x-text="item.doctor.name"></span>
                            </td>
                            <td class="p-4">
                                <span x-text="item.name"></span>
                            </td>
                            <td class="p-4">
                                <span x-text="item.email"></span>
                            </td>
                            <td class="p-4">
                                <span x-text="item.age ?? '-'"></span>
                            </td>
                            <td class="p-4">
                                <span x-text="item.mobile_number"></span>
                            </td>
                            <td class="p-4">
                                <span x-text="item.amount"></span>
                            </td>
                            <td class="p-4">
                                <span x-text="item.date"></span>
                            </td>
                            <td class="p-4">
                                <span x-text="item.time"></span>
                            </td>

                            <td class="p-4" x-show="item.status === 'active'">
                                    <span
                                            class="inline-flex overflow-hidden rounded-none border border-green-600 px-1 py-0.5
                                            text-xs font-medium text-green-600 bg-green-600/10">
                                        Active
                                    </span>
                            </td>

                            <td class="p-4" x-show="item.status === 'inactive'">
                                    <span
                                            class="inline-flex overflow-hidden rounded-none border border-red-600 px-1
                                            py-0.5 text-xs font-medium text-red-600 bg-red-600/10">
                                        Inactive
                                    </span>
                            </td>

                            <td class="p-4" x-show="item.status === 'pending'">
                                    <span
                                            class="inline-flex overflow-hidden rounded-none border border-yellow-600 px-1
                                            py-0.5 text-xs font-medium text-yellow-600 bg-yellow-600/10">
                                        Pending
                                    </span>
                            </td>

                        </tr>
                    </template>
                    </tbody>
                </table>
            </div>


            {{--            <template id="my-template">--}}
            {{--                <swal-title>--}}
            {{--                    Refund Policy For Appointments--}}
            {{--                </swal-title>--}}
            {{--                <swal-icon type="info" color="orange"></swal-icon>--}}
            {{--                <swal-html>--}}
            {{--                    <b>Patient Cancellations:</b><br>--}}
            {{--                    Full refund for cancellations made 24+ hours before the appointment; non-refundable otherwise.<br>--}}
            {{--                    <b>Rescheduling:</b><br>--}}
            {{--                    Free rescheduling if requested 24+ hours in advance.<br>--}}
            {{--                    <b>Provider Cancellations:</b><br>--}}
            {{--                    Full refund or free rescheduling offered.<br>--}}
            {{--                    <b>No-Shows:</b><br>--}}
            {{--                    No refund for missed appointments without notice.<br>--}}
            {{--                </swal-html>--}}
            {{--                <swal-button type="confirm">--}}
            {{--                    Save As--}}
            {{--                </swal-button>--}}
            {{--                <swal-button type="cancel">--}}
            {{--                    Cancel--}}
            {{--                </swal-button>--}}
            {{--                <swal-button type="deny">--}}
            {{--                    Close without Saving--}}
            {{--                </swal-button>--}}
            {{--                <swal-param name="allowEscapeKey" value="false"/>--}}
            {{--                <swal-param--}}
            {{--                        name="customClass"--}}
            {{--                        value='{ "popup": "my-popup" }'/>--}}
            {{--                <swal-function-param--}}
            {{--                        name="didOpen"--}}
            {{--                        value="popup => console.log(popup)"/>--}}
            {{--            </template>--}}

        </div>
    </div>


    <script>
        const MONTH_NAMES = ['January', 'February', 'March',
            'April', 'May', 'June',
            'July', 'August', 'September',
            'October', 'November', 'December'];
        const DAYS = ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'];

        function formModel() {
            return {
                modalIsOpen: @json($selectedDoc) ? true : false,
                formData: {
                    doctor: '',
                    date: '',
                    name: '',
                    age: '',
                    mobile: '',
                    email: '',
                    is_other: false
                },
                isLoading: false,
                errors: {},
                submitForm() {

                    this.isLoading = true;
                    axios.post('{{ route('store-appointment') }}', this.formData)
                        .then(response => {
                            this.isLoading = false;
                            this.close();
                            this.get();

                            Swal.fire({
                                html: `<div style="text-align: left; margin-top: 12px;">
                                <h2 style="text-align: center;font-weight: bold;">Charges Breakdown</h2><br>
                                <table style="width: 100%; border-collapse: collapse;">
                                    <tbody>
                                        <tr>
                                            <td style="padding: 8px; ">Consultation Fee</td>
                                            <td style="padding: 8px; text-align: right;">LKR</td>
                                            <td style="padding: 8px; text-align: right;">`+response.data.doctorCharge+`</td>
                                        </tr>
                                        <tr>
                                            <td style="padding: 8px; ">Service Charges</td>
                                            <td style="padding: 8px; text-align: right;">LKR</td>
                                            <td style="padding: 8px; text-align: right;">`+response.data.serviceCharge+`</td>
                                        </tr>
                                        <tr>
                                            <td style="padding: 8px; border-bottom: 1px solid #ddd; font-weight: bold;">Total Amount</td>
                                            <td style="padding: 8px; border-bottom: 1px solid #ddd; font-weight: bold; text-align: right;">LKR</td>
                                            <td style="padding: 8px; border-bottom: 1px solid #ddd; font-weight: bold; text-align: right;">`+response.data.total+`</td>
                                        </tr>
                                    </tbody>
                                </table>
                                <br><h2 style="text-align: center;font-weight: bold;">Refund Policy for Appointments</h2><br>
                                <b>Patient Cancellations</b><br>
                                Full refund for cancellations made 24+ hours before the appointment; non-refundable otherwise.<br><br>
                                <b>Rescheduling</b><br>
                                Free rescheduling if requested 24+ hours in advance.<br><br>
                                <b>Provider Cancellations</b><br>
                                Full refund or free rescheduling offered.<br><br>
                                <b>No-Shows</b><br>
                                No refund for missed appointments without notice.<br>
                                </div>`,
                                showCancelButton: false,
                                confirmButtonColor: "#3085d6",
                                cancelButtonColor: "#d33",
                                confirmButtonText: "Accept",
                                showDenyButton: true,
                                denyButtonText: "Reject"
                            }).then((result) => {

                                if (result.isConfirmed) {
                                    if (response.data.url) {
                                        window.location.href = response.data.url;
                                    }
                                }

                                if (result.isDenied) {
                                    this.close();
                                    this.get();
                                }
                            });

                        })
                        .catch(error => {
                            this.isLoading = false;
                            if (error.response && error.response.status === 422) {
                                this.errors = error.response.data.errors;
                            } else if (error.response && error.response.status === 400) {
                                Swal.fire({
                                    title: 'Error!',
                                    text: error.response.data,
                                    icon: 'error',
                                    confirmButtonText: 'Ok'
                                })
                                this.close();
                            } else {
                                Swal.fire({
                                    title: 'Error!',
                                    text: 'An unexpected error occurred. Please try again.',
                                    icon: 'error',
                                    confirmButtonText: 'Ok'
                                })
                                this.close();
                            }
                        });

                },
                resetFormData() {
                    this.formData = {
                        doctor: '',
                        date: '',
                        name: '',
                        age: '',
                        mobile: '',
                        is_other: false,
                        email: ''
                    };
                },
                initModel() {
                    this.formData.doctor = @json($selectedDoc);
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
                }
            }
        }

        function getAppointment() {
            return {
                dataSet: [],
                infoModalIsOpen: false,
                get() {
                    axios.get('{{ route('get-appointment') }}')
                        .then(response => {
                            this.dataSet = response.data;
                        })
                        .catch(error => {
                            console.error(error);
                        });
                }
            }
        }

        function app() {
            return {
                showDatepicker: false,
                datepickerValue: '',
                month: '',
                year: '',
                no_of_days: [],
                blankdays: [],
                isDisable: false,
                days: ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'],

                initDate() {
                    let today = new Date()
                    this.month = today.getMonth()
                    this.year = today.getFullYear()

                    const urlParams = new URLSearchParams(window.location.search);

                    if (urlParams.get('date')) {
                        today = new Date(urlParams.get('date'));
                        this.month = today.getMonth()
                        this.year = today.getFullYear()
                        this.isDisable = true
                        this.getDateValue(today.getDate())
                    } else {
                        this.isDisable = false
                    }


                    // this.datepickerValue =
                    //     new Date(this.year,
                    //         this.month,
                    //         today.getDate()).toDateString()
                },

                isToday(date) {
                    const today = new Date()
                    const d = new Date(this.year, this.month, date)
                    return today.toDateString() === d.toDateString() ? true : false
                },

                getDateValue(date) {
                    let selectedDate = new Date(this.year, this.month, date)
                    this.datepickerValue = selectedDate.toDateString()
                    this.formData.date = selectedDate.toDateString()
                    this.$refs.date.value =
                        selectedDate.getFullYear()
                        + "-"
                        + ('0'
                            + selectedDate.getMonth()).slice(-2)
                        + "-"
                        + ('0'
                            + selectedDate.getDate()).slice(-2)
                    this.showDatepicker = false
                },

                getNoOfDays() {
                    let daysInMonth = new Date(this.year, this.month + 1, 0).getDate()

                    // find where to start calendar day of week
                    let dayOfWeek = new Date(this.year, this.month).getDay()
                    let blankdaysArray = []
                    for (var i = 1; i <= dayOfWeek; i++) {
                        blankdaysArray.push(i)
                    }

                    let daysArray = []
                    for (var i = 1; i <= daysInMonth; i++) {
                        daysArray.push(i)
                    }

                    this.blankdays = blankdaysArray
                    this.no_of_days = daysArray
                },

                showPicker() {
                    console.log(this.isDisable)
                    if (this.isDisable == false) {
                        this.showDatepicker = !this.showDatepicker
                    }
                }
            }
        }

        function doctorSelectComponent() {
            return {
                allOptions: @json($doctors),
                options: [],
                isOpen: false,
                openedWithKeyboard: false,
                selectedOption: null,
                setSelectedOption(option) {
                    this.selectedOption = option;
                    this.isOpen = false;
                    this.openedWithKeyboard = false;
                    this.$refs.hiddenTextField.value = option.id;
                    this.formData.doctor = option.id;
                },
                getFilteredOptions(query) {
                    this.options = this.allOptions.filter(option =>
                        option.label.toLowerCase().includes(query.toLowerCase())
                    );
                    if (this.options.length === 0) {
                        this.$refs.noResultsMessage.classList.remove('hidden');
                    } else {
                        this.$refs.noResultsMessage.classList.add('hidden');
                    }
                },
                handleKeydownOnOptions(event) {
                    if ((event.keyCode >= 65 && event.keyCode <= 90) || (event.keyCode >= 48 && event.keyCode <= 57) || event.keyCode === 8) {
                        this.$refs.searchField.focus();
                    }
                },
                init() {

                    this.options = this.allOptions;
                    const preselectedId =  @json($selectedDoc) ??
                    '';

                    if (preselectedId) {
                        this.selectedOption = this.allOptions.find(option => option.id == preselectedId);

                        if (this.selectedOption) {
                            this.$refs.hiddenTextField.value = this.selectedOption.id;
                            this.formData.doctor = this.selectedOption.id;
                        }
                    }
                }
            }
        }
    </script>
</x-guest-layout>