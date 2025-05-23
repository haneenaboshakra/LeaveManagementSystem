<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight text-center">
            {{ __('Leave Requests History') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-screen-2xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="overflow-x-auto">
                <table class="w-full bg-white border border-gray-300 rounded-lg shadow">
                    <thead>
                        <tr class="bg-gray-100 text-center">
                            <th class="p-4">Id</th>
                            <th class="p-4">Employee Name</th>
                            <th class="p-4">Role</th>
                            <th class="p-4">Department name</th>
                            <th class="p-4">Manager name</th>
                            <th class="p-4">status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($leaveRequests as $leaveRequest)
                            <tr class="border-t hover:bg-gray-50 text-center">
                                <td class="p-4 ">{{ $leaveRequest->id }}</td>
                                <td class="p-4">{{ $leaveRequest->user->name }}</td>
                                <td class="p-4 capitalize">{{ $leaveRequest->user->role }}</td>
                                <td class="p-4 capitalize">{{ $leaveRequest->user->department->name }}</td>
                                <td class="p-4 capitalize">
                                    {{ $leaveRequest->reviewer ? $leaveRequest->reviewer->name : 'Pending' }}
                                </td>
                                <td class="p-4 capitalize">{{ $leaveRequest->status }}</td>
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
