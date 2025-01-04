<x-guest-layout>
    <div class="mx-auto sm:px-6 lg:px-8">
        <div class="w-full" x-data="getSpeciality()" x-init="get()">
            <div class="flex justify-between">
                <p class="mb-6 text-lg font-semibold">Speciality</p>
                <div x-data="formModel()">
                    <button @click="modalIsOpen = true" type="button"
                            class="cursor-pointer  px-4 py-2 text-sm font-bold text-white rounded-[30px] border-2 border-white bg-gradient-to-r from-blue-400
               to-green-400 hover:from-blue-500 hover:to-green-500 focus:outline-none focus:ring-2 focus:ring-blue-400 focus:ring-offset-1">
                        Add new Speciality
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
                                <h3 id="defaultModalTitle" class="font-semibold tracking-wide text-neutral-900">Add New
                                    Speciality</h3>
                                <button @click="modalIsOpen = false" aria-label="close modal">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" aria-hidden="true"
                                         stroke="currentColor" fill="none" stroke-width="1.4" class="w-5 h-5">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/>
                                    </svg>
                                </button>
                            </div>
                            <form @submit.prevent="submitForm" x-data="specialityForm()">
                                <!-- Dialog Body -->
                                <div class="px-8 pb-4">
                                    @csrf
                                    <div class="flex w-full flex-col gap-1 text-neutral-600">
                                        <label for="textInputDefault" class="w-fit pl-0.5 text-sm">Name</label>
                                        <input id="textInputDefault" type="text" class="w-full rounded-md border border-neutral-300
                            bg-neutral-50 px-2 py-2 text-sm focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2
                            focus-visible:outline-black disabled:cursor-not-allowed disabled:opacity-75 "
                                               name="name" placeholder="Enter name" x-model="formData.name" autocomplete="name"/>
                                        <template x-if="errors.name">
                                            <p class="text-red-500 text-xs mt-1" x-text="errors.name[0]"></p>
                                        </template>
                                    </div>

                                    <div class="flex w-full mt-4 flex-col gap-1 text-neutral-600">
                                        <label for="textInputDefault"
                                               class="w-fit pl-0.5 text-sm">Description</label>
                                        <input id="textInputDefault" type="text" class="w-full rounded-md border border-neutral-300
                            bg-neutral-50 px-2 py-2 text-sm focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2
                            focus-visible:outline-black disabled:cursor-not-allowed disabled:opacity-75 "
                                               name="description" placeholder="Enter description" x-model="formData.description"
                                               autocomplete="description"/>
                                        <template x-if="errors.description">
                                            <p class="text-red-500 text-xs mt-1" x-text="errors.description[0]"></p>
                                        </template>
                                    </div>
                                </div>
                                <!-- Dialog Footer -->
                                <div class="flex flex-col-reverse justify-between gap-2 border-t border-neutral-300 bg-neutral-50/60 p-4 sm:flex-row sm:items-center md:justify-end">
                                    <button type="submit"
                                            class="flex cursor-pointer items-center justify-center gap-2 whitespace-nowrap bg-black px-4 py-2 text-center text-sm font-medium tracking-wide text-neutral-100 transition hover:opacity-75 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-black active:opacity-100 active:outline-offset-0  rounded-md">
                                        <svg x-show="isLoading" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" class="size-5 animate-spin motion-reduce:animate-none fill-neutral-100" >
                                            <path opacity="0.25" d="M12,1A11,11,0,1,0,23,12,11,11,0,0,0,12,1Zm0,19a8,8,0,1,1,8-8A8,8,0,0,1,12,20Z" />
                                            <path d="M10.14,1.16a11,11,0,0,0-9,8.92A1.59,1.59,0,0,0,2.46,12,1.52,1.52,0,0,0,4.11,10.7a8,8,0,0,1,6.66-6.61A1.42,1.42,0,0,0,12,2.69h0A1.57,1.57,0,0,0,10.14,1.16Z" />
                                        </svg>
                                        Create
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
            </div>

            <div class="bg-white overflow-hidden w-full overflow-x-auto rounded-md border border-neutral-300">
                <table class="w-full text-left text-sm text-neutral-600">
                    <thead class="border-b border-neutral-300 bg-neutral-50 text-sm text-neutral-900">
                    <tr>
                        <th scope="col" class="p-2">Name</th>
                        <th scope="col" class="p-2">Description</th>
                        <th scope="col" class="p-2"></th>
                        <th scope="col" class="p-2"></th>
                    </tr>
                    </thead>
                    <tbody class="divide-y divide-neutral-300">
                    <!-- Bind rows dynamically to dataSet -->
                    <template x-for="item in dataSet" :key="item.id">
                        <tr>
                            <td class="p-4">
                                <span x-text="item.name"></span>
                            </td>
                            <td class="p-4">
                                <span x-text="item.description"></span>
                            </td>
                            <td class="p-4">
                                <!-- Edit Button -->
                                <div x-data="{modalIsOpen: false}">
                                    <button @click="modalIsOpen = true" type="button"
                                            class="cursor-pointer inline-flex justify-center items-center gap-2 whitespace-nowrap rounded-md bg-amber-500 px-3 py-2 text-sm font-medium tracking-wide text-white transition hover:opacity-75">
                                        Edit
                                    </button>
                                    <!-- Modal -->
                                    <div x-cloak x-show="modalIsOpen" x-transition.opacity.duration.200ms
                                         @keydown.esc.window="modalIsOpen = false" @click.self="modalIsOpen = false"
                                         class="fixed inset-0 z-30 flex items-end justify-center bg-black/20 p-4 pb-8 backdrop-blur-md sm:items-center lg:p-8"
                                         role="dialog" aria-modal="true">
                                        <div class="flex w-full max-w-lg flex-col gap-4 overflow-hidden rounded-md border border-neutral-300 bg-white text-neutral-600">
                                            <!-- Dialog Header -->
                                            <div class="flex items-center justify-between border-b border-neutral-300 bg-neutral-50/60 p-4">
                                                <h3 class="font-semibold tracking-wide text-neutral-900">Edit Speciality</h3>
                                                <button @click="modalIsOpen = false" aria-label="close modal">
                                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" aria-hidden="true" stroke="currentColor" fill="none" stroke-width="1.4" class="w-5 h-5">
                                                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/>
                                                    </svg>
                                                </button>
                                            </div>
                                            <form method="POST" :action="`{{ url('admin/edit-speciality') }}/${item.id}`">
                                                @method('PATCH')
                                                @csrf
                                                <div class="px-8 pb-4">
                                                    <div class="flex w-full flex-col gap-1 text-neutral-600">
                                                        <label for="name" class="w-fit pl-0.5 text-sm">Name</label>
                                                        <input id="name" type="text" class="w-full rounded-md border border-neutral-300 bg-neutral-50 px-2 py-2 text-sm focus:outline-black"
                                                               name="name" x-bind:value="item.name" />
                                                    </div>
                                                    <div class="flex w-full mt-4 flex-col gap-1 text-neutral-600">
                                                        <label for="description" class="w-fit pl-0.5 text-sm">Description</label>
                                                        <input id="description" type="text" class="w-full rounded-md border border-neutral-300 bg-neutral-50 px-2 py-2 text-sm focus:outline-black"
                                                               name="description" x-bind:value="item.description" />
                                                    </div>
                                                </div>
                                                <div class="flex flex-col-reverse justify-between gap-2 border-t border-neutral-300 bg-neutral-50/60 p-4 sm:flex-row sm:items-center md:justify-end">
                                                    <button type="submit" class="bg-black px-4 py-2 text-sm text-white rounded-md">Update</button>
                                                    <button type="button" @click="modalIsOpen = false" class="bg-gray-300 px-4 py-2 text-sm rounded-md">Cancel</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </td>
                            <td class="p-4">
                                <!-- Delete Button -->
                                <form method="POST" :action="`{{ url('admin/delete-speciality') }}/${item.id}`">
                                    @method('DELETE')
                                    @csrf
                                    <button type="submit" class="cursor-pointer inline-flex justify-center items-center gap-2 rounded-md bg-red-500 px-3 py-2 text-sm text-white transition hover:opacity-75">
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
        function formModel () {
            return {
                modalIsOpen : false,
                close() {
                    this.modalIsOpen = false
                }
            }
        }

        function getSpeciality() {
            return {
                dataSet: [],
                get() {
                    axios.get('{{ route('admin.get-speciality') }}')
                        .then(response => {
                            this.dataSet = response.data;
                        })
                        .catch(error => {
                            console.error(error);
                        });
                }
            }
        }

        function specialityForm() {
            return {
                formData: {
                    description: '',
                    name: '',
                },
                isLoading: false,
                errors: {},
                submitForm() {
                    this.isLoading = true;
                    axios.post('{{ route('admin.store-speciality') }}', this.formData)
                        .then(response => {
                            Swal.fire({
                                position: "top-end",
                                icon: "success",
                                title: "Speciality created successfully!",
                                showConfirmButton: false,
                                timer: 1500
                            });
                            this.isLoading = false;
                            this.close();
                            this.get();
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
                            }
                        });
                }
            }
        }
    </script>

</x-guest-layout>