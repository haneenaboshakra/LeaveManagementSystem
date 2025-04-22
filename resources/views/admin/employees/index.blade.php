<x-app-layout>
    <x-slot name="header">
        <div class="d-flex justify-between items-center w-full text-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('All Employees') }}
            </h2>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight text-left">
                <a href="{{ route('admin.employees.create') }}" class="text-blue-500 hover:text-blue-700">
                    {{ __('Add Employee') }}
                </a>
            </h2>
        </div>
        
        
    </x-slot>

    <div class="py-12">
        <div class="max-w-screen-2xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="overflow-x-auto">
                <table class="w-full bg-white border border-gray-300 rounded-lg shadow">
                    <thead>
                        <tr class="bg-gray-100 text-center">
                            <th class="p-4">Id</th>
                            <th class="p-4">Name</th>
                            <th class="p-4">role</th>
                            <th class="p-4">Department name</th>
                            <th class="p-4">Manager name</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($employees as $employee)
                            <tr class="border-t hover:bg-gray-50 text-center">
                                <td class="p-4">
                                    <a href="{{ route('admin.employees.show', $employee->id) }}" class="text-blue-600 hover:underline">
                                        {{ $employee->id }}
                                    </a>
                                </td>
                                <td class="p-4">{{ $employee->name }}</td>
                                <td class="p-4 capitalize">{{ $employee->role }}</td>
                                <td class="p-4 capitalize">{{ $employee->department->name }}</td>
                                <td class="p-4 capitalize">{{ $employee->manager->name }}</td>
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
