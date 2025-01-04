<x-guest-layout>
        <div class="mx-auto sm:px-6 lg:px-8">
            <div class="md:flex items-center justify-center md:space-x-40">
                <div class="grid grid-cols-2 gap-8">
                    <a href="{{route('admin.dashboard')}}" class="text-center px-8 py-8 border-8 border-white bg-gradient-to-r from-[#e3f6fb] to-[#e2f8f3] text-gray-500 font-medium rounded-[20px] shadow-md hover:shadow-lg
                    font-semibold md:text-4xl antialiased
                    ">
                        Dashboard
                    </a>

                    <a href="{{route('admin.add-speciality')}}" class="text-center px-8 py-8 border-8 border-white bg-gradient-to-r from-[#e3f6fb] to-[#e2f8f3] text-gray-500 font-medium rounded-[20px] shadow-md hover:shadow-lg
                    font-semibold md:text-4xl antialiased
                    ">
                        Add Speciality
                    </a>

                    <a href="{{route('admin.add-doctor')}}" class="text-center px-8 py-8 border-8 border-white bg-gradient-to-r from-[#e3f6fb] to-[#e2f8f3] text-gray-500 font-medium rounded-[20px] shadow-md hover:shadow-lg
                    font-semibold md:text-4xl antialiased
                    ">
                        Add Doctor
                    </a>

                    <a href="{{route('admin.view-appointments')}}" class="text-center px-8 py-8 border-8 border-white bg-gradient-to-r from-[#e3f6fb] to-[#e2f8f3] text-gray-500 font-medium rounded-[20px] shadow-md hover:shadow-lg
                    font-semibold md:text-4xl antialiased
                    ">
                        Appointments
                    </a>
                    <a href="{{route('admin.users')}}" class="text-center px-8 py-8 border-8 border-white bg-gradient-to-r from-[#e3f6fb] to-[#e2f8f3] text-gray-500 font-medium rounded-[20px] shadow-md hover:shadow-lg
                    font-semibold md:text-4xl antialiased
                    ">
                        Users
                    </a>
                </div>
                <div class="">
                    <x-doc-img/>
                </div>
            </div>
        </div>
</x-guest-layout>