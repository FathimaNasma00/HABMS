<x-guest-layout>
    <div class="mx-auto sm:px-6 lg:px-8">
        <div class="w-full">
            <div class="bg-white overflow-hidden w-full overflow-x-auto rounded-md border border-neutral-300 ">
                <table class="w-full text-left text-sm text-neutral-600 ">
                    <thead class="border-b border-neutral-300 bg-neutral-50 text-sm text-neutral-900 ">
                    <tr>
                        <th scope="col" class="p-2">Patient Name</th>
                        <th scope="col" class="p-2">Age</th>
                        <th scope="col" class="p-2">Mobile No</th>
                        <th scope="col" class="p-2">Date</th>
                        <th scope="col" class="p-2">Time</th>
                        <th scope="col" class="p-2">Amount</th>
                        <th scope="col" class="p-2">Status</th>
                    </tr>
                    </thead>
                    <tbody class="divide-y divide-neutral-300 ">
                    @foreach($data as $item)
                        <tr>
                            <td class="p-4 ">
                                {{$item->name}}
                            </td>

                            <td class="p-4 ">
                                {{$item->age ?? '-'}}
                            </td>

                            <td class="p-4 ">
                                {{$item->mobile_number}}
                            </td>

                            <td class="p-4 ">
                                {{$item->date}}
                            </td>

                            <td class="p-4 ">
                                {{$item->time}}
                            </td>

                            <td class="p-4 ">
                                {{$item->amount}}
                            </td>

                            <td class="p-4 ">
                                {{$item->reminder_send_at ?? '-'}}
                            </td>

                            @if($item->status == 'active')
                                <td class="p-4">
                                    <span
                                            class="inline-flex overflow-hidden rounded-none border border-green-600 px-1 py-0.5
                                            text-xs font-medium text-green-600 bg-green-600/10">
                                        Active
                                    </span>
                                </td>
                            @endif

                            @if($item->status == 'inactive')
                                <td class="p-4">
                                    <span
                                            class="inline-flex overflow-hidden rounded-none border border-red-600 px-1
                                            py-0.5 text-xs font-medium text-red-600 bg-red-600/10">
                                        Inactive
                                    </span>
                                </td>
                            @endif
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>

    </div>
</x-guest-layout>