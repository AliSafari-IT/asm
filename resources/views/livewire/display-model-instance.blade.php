
<div class="max-w-4xl mx-auto py-10">
    <x-slot name="header">
        <h1 class="text-3xl font-bold mb-6">
            {{ 'Display' }} {{ $modelType }}
        </h1>
    </x-slot>
    @if (session()->has('message'))
    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
        {{ session('message') }}
    </div>
    @endif

    <form wire:submit.prevent="routeToEdit"  class="space-y-8">
        @foreach ($data as $field => $value)
        @php
        echo '<input type="hidden" name="data[' . $field . ']" value="' . $value . '" />';
        $initialValue = $initialValues[$field] ?? null;
        $inputType = $fieldTypes[$field] ?? 'text';
        dd ($data,  $instanceModel );
        @endphp

        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2 capitalize">{{ $field }}</label>
            @if($inputType === 'textarea')
            <textarea readonly rows="3" name="data[{{ $field }}]"  disabled
                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                wire:model.defer="data.{{ $field }}" style ="cursor:not-allowed;"></textarea>
            @elseif($inputType === 'checkbox')
            <input disabled name="data[{{ $field }}]" style ="cursor:not-allowed;"
            type="{{ $inputType }}" class="form-checkbox h-5 w-5 text-gray-600"
                wire:model.defer="data.{{ $field }}" @if($value) checked @endif>
                @php 
                    dd($value, $inputType);
                @endphp
            @else
            <input disabled type="{{ $inputType }}" name="data[{{ $field }}]" style ="cursor:not-allowed;"
                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline {{ $field === 'id' ? 'bg-gray-100 disabled' : '' }}"
                {{ $field === 'id' ? 'disabled' : '' }} wire:model.defer="data.{{ $field }}">
            @endif
            @error('data.' . $field) <span
                class="text-red-500 text-xs italic">{{ $errors->first('data.' . $field) }}</span> @enderror
        </div>
        @endforeach

        <div class="flex items-center justify-between">
            <a href="{{ route('permissions.index') }}"
                class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">Back</a>
            <button type="submit"
                class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                Edit Instance </button>
        </div>
    </form>
</div>