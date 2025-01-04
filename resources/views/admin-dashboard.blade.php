<x-guest-layout>

        <div class="mx-auto sm:px-6 lg:px-8">

            <div class="grid grid-cols-1 gap-4 px-4 mt-8 sm:grid-cols-5 sm:px-8">
                <div class="flex items-center bg-white border rounded-sm overflow-hidden shadow">
                    <div class="p-4 bg-green-400"><svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-white" fill="none"
                                                       viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z">
                            </path>
                        </svg></div>
                    <div class="px-4 text-gray-700">
                        <h3 class="text-sm tracking-wider font-semibold">Total Doctors</h3>
                        <p class="text-3xl">{{$doctors}}</p>
                    </div>
                </div>
                <div class="flex items-center bg-white border rounded-sm overflow-hidden shadow">
                    <div class="p-4 bg-blue-400"><svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-white" fill="none"
                                                      viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M8 7v8a2 2 0 002 2h6M8 7V5a2 2 0 012-2h4.586a1 1 0 01.707.293l4.414 4.414a1 1 0 01.293.707V15a2 2 0 01-2 2h-2M8 7H6a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2v-2">
                            </path>
                        </svg></div>
                    <div class="px-4 text-gray-700">
                        <h3 class="text-sm tracking-wider font-semibold">Total Appointments</h3>
                        <p class="text-3xl">{{$appointments}}</p>
                    </div>
                </div>
                <div class="flex items-center bg-white border rounded-sm overflow-hidden shadow">
                    <div class="p-4 bg-orange-400">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-white" fill="none"
                                                      viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M8 7v8a2 2 0 002 2h6M8 7V5a2 2 0 012-2h4.586a1 1 0 01.707.293l4.414 4.414a1 1 0 01.293.707V15a2 2 0 01-2 2h-2M8 7H6a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2v-2">
                            </path>
                        </svg>
                    </div>
                    <div class="px-4 text-gray-700">
                        <h3 class="text-sm tracking-wider font-semibold">Transaction</h3>
                        <p class="text-3xl">Rs. {{number_format($totalTransaction, 2)}}</p>
                    </div>
                </div>
                <div class="flex items-center bg-white border rounded-sm overflow-hidden shadow">
                    <div class="p-4 bg-indigo-400"><svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-white" fill="none"
                                                        viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M17 8h2a2 2 0 012 2v6a2 2 0 01-2 2h-2v4l-4-4H9a1.994 1.994 0 01-1.414-.586m0 0L11 14h4a2 2 0 002-2V6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2v4l.586-.586z">
                            </path>
                        </svg></div>
                    <div class="px-4 text-gray-700">
                        <h3 class="text-sm tracking-wider font-semibold">Total Patients</h3>
                        <p class="text-3xl">{{$patients}}</p>
                    </div>
                </div>
                <div class="flex items-center bg-white border rounded-sm overflow-hidden shadow">
                    <div class="p-4 bg-red-400"><svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-white" fill="none"
                                                     viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M4 7v10c0 2.21 3.582 4 8 4s8-1.79 8-4V7M4 7c0 2.21 3.582 4 8 4s8-1.79 8-4M4 7c0-2.21 3.582-4 8-4s8 1.79 8 4m0 5c0 2.21-3.582 4-8 4s-8-1.79-8-4">
                            </path>
                        </svg></div>
                    <div class="px-4 text-gray-700">
                        <h3 class="text-sm tracking-wider font-semibold">Total Speciality</h3>
                        <p class="text-3xl">{{$speciality}}</p>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-2  gap-8 mt-16">

                <div class="w-full">
                    <p class="mb-6 text-lg font-semibold">New Appointments</p>
                    <div class="bg-white overflow-hidden w-full overflow-x-auto rounded-md border border-neutral-300">
                        <table class="w-full text-left text-sm text-neutral-600">
                            <thead class="border-b border-neutral-300 bg-neutral-50 text-sm text-neutral-900">
                            <tr>
                                <th scope="col" class="p-2">ID</th>
                                <th scope="col" class="p-2">Patient Name</th>
                                <th scope="col" class="p-2">Age</th>
                                <th scope="col" class="p-2">Mobile No</th>
                                <th scope="col" class="p-2">Date</th>
                                <th scope="col" class="p-2">Time</th>
                                <th scope="col" class="p-2">Amount</th>
                                <th scope="col" class="p-2">Status</th>
                            </tr>
                            </thead>
                            <tbody class="divide-y divide-neutral-300">
                            @foreach($latestAppointments as $item)
                                <tr>
                                    <td class="p-4">{{$item->id}}</td>
                                    <td class="p-4">{{$item->name}}</td>
                                    <td class="p-4">{{$item->age}}</td>
                                    <td class="p-4">{{$item->mobile_number}}</td>
                                    <td class="p-4">{{$item->date}}</td>
                                    <td class="p-4">{{$item->time}}</td>
                                    <td class="p-4">{{$item->amount}}</td>
                                    <td class="p-4">{{$item->status}}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="w-full">
                    <p class="mb-6 text-lg font-semibold">New Payments</p>
                    <div class="bg-white overflow-hidden w-full overflow-x-auto rounded-md border border-neutral-300">
                        <table class="w-full text-left text-sm text-neutral-600">
                            <thead class="border-b border-neutral-300 bg-neutral-50 text-sm text-neutral-900">
                            <tr>
                                <th scope="col" class="p-1">Appointment Id</th>
                                <th scope="col" class="p-1">Amount</th>
                                <th scope="col" class="p-1">Method</th>
                                <th scope="col" class="p-1">Card</th>
                                <th scope="col" class="p-1">Status</th>
                            </tr>
                            </thead>
                            <tbody class="divide-y divide-neutral-300">
                            @foreach($latestTransactions as $item)
                                <tr>
                                    <td class="p-4">{{$item->appointment_id}}</td>
                                    <td class="p-4">{{$item->amount}}</td>
                                    <td class="p-4">{{$item->method}}</td>
                                    <td class="p-4">{{$item->card}}</td>
                                    <td class="p-4">{{$item->status}}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="w-full">
                    <p class="mb-6 text-lg font-semibold">New Doctors</p>
                    <div class="bg-white overflow-hidden w-full overflow-x-auto rounded-md border border-neutral-300">
                        <table class="w-full text-left text-sm text-neutral-600">
                            <thead class="border-b border-neutral-300 bg-neutral-50 text-sm text-neutral-900">
                            <tr>
                                <th scope="col" class="p-1">Name</th>
                                <th scope="col" class="p-1">Email</th>
                                <th scope="col" class="p-1">Charges</th>
                            </tr>
                            </thead>
                            <tbody class="divide-y divide-neutral-300">
                            @foreach($latestDoctors as $item)
                                <tr>
                                    <td class="p-4">{{$item->name}}</td>
                                    <td class="p-4">{{$item->email}}</td>
                                    <td class="p-4">{{$item->amount}}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>


        </div>
</x-guest-layout>