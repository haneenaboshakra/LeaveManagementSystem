<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Employee') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            @if (session('success'))
                <div class="mb-4 text-green-600 font-bold">
                    {{ session('success') }}
                </div>
            @endif

            <div class="bg-white p-6 rounded shadow border border-gray-200">
                <form action="{{ route('admin.employees.update', $employee->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <!-- Name -->
                    <div class="mb-4">
                        <label for="name" class="block text-gray-700 font-medium mb-2">Name</label>
                        <input type="text" name="name" value="{{ $employee->name }}" class="w-full border-gray-300 rounded shadow-sm" required>
                    </div>

                    <!-- Email -->
                    <div class="mb-4">
                        <label for="email" class="block text-gray-700 font-medium mb-2">Email</label>
                        <input type="email" name="email" value="{{ $employee->email }}" class="w-full border-gray-300 rounded shadow-sm" required>
                    </div>

                    <!-- Department -->
                    <div class="mb-4">
                        <label for="department_id" class="block text-gray-700 font-medium mb-2">Department</label>
                        <select name="department_id" class="w-full border-gray-300 rounded shadow-sm" required>
                            @foreach ($departments as $department)
                                <option value="{{ $department->id }}" {{ $employee->department_id == $department->id ? 'selected' : '' }}>
                                    {{ $department->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Manager -->
                    <div class="mb-4">
                        <label for="manager_id" class="block text-gray-700 font-medium mb-2">Manager</label>
                        <select name="manager_id" class="w-full border-gray-300 rounded shadow-sm" required>
                            @foreach ($managers as $manager)
                                <option value="{{ $manager->id }}" {{ $employee->manager_id == $manager->id ? 'selected' : '' }}>
                                    {{ $manager->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mt-6 flex space-x-4">
                        <!-- Update Button -->
                        <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded">
                            Update Employee
                        </button>
                    
                        <!-- Delete Button -->
                        </form> <!-- close the update form -->
                        <form action="{{ route('admin.employees.destroy', $employee->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded">
                                Delete Employee
                            </button>
                        </form>
                    </div>
            </div>
        </div>
    </div>
</x-app-layout>
