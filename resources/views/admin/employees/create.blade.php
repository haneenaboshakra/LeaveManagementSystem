<x-app-layout>
    <x-slot name="header">
        <div class="d-flex justify-between items-center w-full text-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('All Employees') }}
            </h2>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight text-left">
                <a href="{{ route('admin.employees.index') }}" class="text-blue-500 hover:text-blue-700">
                    {{ __('Back') }}
                </a>
            </h2>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white p-6 rounded shadow border border-gray-200">
                <form action="{{ route('admin.employees.store') }}" method="POST">
                    @csrf

                    <!-- Employee Name -->
                    <div class="mb-4">
                        <label for="name" class="block text-gray-700 font-medium mb-2">Employee Name</label>
                        <input type="text" name="name" id="name" class="w-full border-gray-300 rounded shadow-sm" required>
                    </div>

                    <!-- Employee Email -->
                    <div class="mb-4">
                        <label for="email" class="block text-gray-700 font-medium mb-2">Employee Email</label>
                        <input type="email" name="email" id="email" class="w-full border-gray-300 rounded shadow-sm" required>
                    </div>

                    <!-- Department Assignment -->
                    <div class="mb-4">
                        <label for="department_id" class="block text-gray-700 font-medium mb-2">Select Department</label>
                        <select name="department_id" id="department_id" class="w-full border-gray-300 rounded shadow-sm" required>
                            <option value="">Select Department</option>
                            @foreach($departments as $department)
                                <option value="{{ $department->id }}">{{ $department->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Manager Assignment -->
                    <div class="mb-4">
                        <label for="manager_id" class="block text-gray-700 font-medium mb-2">Assign Manager</label>
                        <select name="manager_id" id="manager_id" class="w-full border-gray-300 rounded shadow-sm" required>
                            <option value="">Select Manager</option>
                            @foreach($managers as $manager)
                                <option value="{{ $manager->id }}">{{ $manager->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Password -->
                    <div class="mb-4">
                        <label for="password" class="block text-gray-700 font-medium mb-2">Password</label>
                        <input type="password" name="password" id="password" class="w-full border-gray-300 rounded shadow-sm" required>                    
                    </div>

                    <!-- Submit Button -->
                    <div class="mt-6">
                        <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded">
                            {{ __('Add Employee') }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
