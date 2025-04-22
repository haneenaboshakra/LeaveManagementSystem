<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight text-center">
            {{ __('Available Leave Requests') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-screen-2xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="overflow-x-auto">
                @if (session('success'))
                    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4">
                        {{ session('success') }}
                    </div>
                @endif
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
                                <td class="p-4 capitalize">
                                    <form action="{{ route('manager.employees.updateStatus', $leaveRequest->id) }}" method="POST">
                                        @csrf
                                        <select name="status" id="status" class="w-50 rounded border border-gray-400 px-10 py-1 mb-4">
                                            <option value="pending" {{ $leaveRequest->status == 'pending' ? 'selected' : '' }}>Pending</option>
                                            <option value="approved" {{ $leaveRequest->status == 'approved' ? 'selected' : '' }}>Approved</option>
                                            <option value="rejected" {{ $leaveRequest->status == 'rejected' ? 'selected' : '' }}>Rejected</option>
                                        </select>
                                        <button type="submit" class="px-4 w-50 py-2 bg-blue-500 text-white rounded hover:bg-blue-600">
                                            Update
                                        </button>
                                    </form>
                                </td>
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
