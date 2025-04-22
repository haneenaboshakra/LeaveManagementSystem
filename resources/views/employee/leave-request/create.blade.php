<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold text-gray-800 leading-tight">
            {{ __('Apply for Leave') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white p-6 rounded shadow border border-gray-200">
                <form action="{{ route('employee.leave-request.store') }}" method="POST">
                    @csrf

                    <div class="mb-4">
                        <label for="type" class="block text-gray-700 font-medium mb-2">Leave Type</label>
                        <select name="type" id="type" class="w-full border-gray-300 rounded shadow-sm">
                            <option value="sick">Sick</option>
                            <option value="vacation">Vacation</option>
                            <option value="emergency">Emergency</option>
                            <option value="other">Other</option>
                        </select>
                        @error('type')
                            <span class="text-red-600 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="from_date" class="block text-gray-700 font-medium mb-2">Start Date</label>
                        <input type="date" name="from_date" id="from_date" class="w-full border-gray-300 rounded shadow-sm" required value="{{ old('from_date') }}">
                        @error('from_date')
                            <span class="text-red-600 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="to_date" class="block text-gray-700 font-medium mb-2">End Date</label>
                        <input type="date" name="to_date" id="to_date" class="w-full border-gray-300 rounded shadow-sm" required value="{{ old('to_date') }}">
                        @error('to_date')
                            <span class="text-red-600 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="reason" class="block text-gray-700 font-medium mb-2">Reason (optional)</label>
                        <textarea name="reason" id="reason" rows="4" class="w-full border-gray-300 rounded shadow-sm">{{ old('reason') }}</textarea>
                        @error('reason')
                            <span class="text-red-600 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="mt-6">
                        <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-black px-4 py-2 rounded">
                            Submit Leave Request
                        </button>
                        <a href="{{ route('employee.leave-request.history') }}" class="ml-4 text-gray-600 hover:text-gray-900">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
