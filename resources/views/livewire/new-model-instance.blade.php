<div class="max-w-4xl mx-auto py-10">
    @php
    $data = $this->data;
    $initialValues = $this->permissionModel->initialValues;
    $rules = $this->permissionModel->rules;
    $messages = $this->permissionModel->messages;
    $fieldTypes = $this->permissionModel->fieldTypes;
    $modelType = $this-> modelType ?? 'Permission';
    @endphp
    <x-slot name="header">
        <h1 class="text-3xl font-bold mb-6">Create a new Permission</h1>
    </x-slot>

    @if (session()->has('message'))
    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
        {{ session('message') }}
    </div>
    @endif

    <form wire:submit.prevent="save" class="space-y-8">

        <!-- Form inputs for $permissionModel, adjust according to the model's attributes, e.g., fieldname, fieldtype, and their rules and messages for validation  -->
        @foreach ($data as $field => $value)
        @php
        echo '<input type="hidden" name="data[' . $field . ']" value="' . $value . '" />';
        $initialValue = $initialValues[$field] ?? null;
        $inputType = $fieldTypes[$field] ?? 'text';
        @endphp
        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2 capitalize">{{ $field }}</label>
            @if($inputType === 'textarea')
            <textarea
                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                wire:model.defer="data.{{ $field }}"></textarea>
            @elseif($inputType === 'checkbox')
            <input type="{{ $inputType }}" class="form-checkbox h-5 w-5 text-gray-600"
                wire:model.defer="data.{{ $field }}" @if($value) checked @endif>
            @else
            <input type="{{ $inputType }}"
                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline {{ $field === 'id' ? 'bg-gray-100 disabled' : '' }}"
                {{ $field === 'id' ? 'disabled' : '' }} wire:model.defer="data.{{ $field }}">
            @endif
            @error('data.' . $field) <span
                class="text-red-500 text-xs italic">{{ $errors->first('data.' . $field) }}</span> @enderror
        </div>
        @endforeach


        <!-- Add more inputs as needed -->

        <div class="flex items-center justify-between">
            <a href="{{ route('permissions.index') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">Back</a>
            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">Add New Permission</button>
        </div>
    </form>
</div>
