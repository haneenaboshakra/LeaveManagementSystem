<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight text-center">
            {{ __('My Leave Requests') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-screen-2xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="overflow-x-auto">
                <table class="w-full bg-white border border-gray-300 rounded-lg shadow">
                    <thead>
                        <tr class="bg-gray-100 text-center">
                            <th class="p-4">From</th>
                            <th class="p-4">To</th>
                            <th class="p-4">Type</th>
                            <th class="p-4">Status</th>
                            <th class="p-4">Reason</th>
                            <th class="p-4">Reviewed By</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($leaveRequests as $request)
                            <tr class="border-t hover:bg-gray-50 text-center">
                                <td class="p-4 ">{{ $request->from_date }}</td>
                                <td class="p-4">{{ $request->to_date }}</td>
                                <td class="p-4 capitalize">{{ $request->type }}</td>
                                <td class="p-4 capitalize">{{ $request->status }}</td>
                                <td class="p-4">{{ $request->reason ?? 'N/A' }}</td>
                                <td class="p-4">{{ $request->reviewer->name ?? 'Pending' }}</td>
                            </tr>
                        @empty
                            <tr class="border-t text-center">
                                <td class="p-4 text-gray-500" colspan="6">No leave requests found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>
