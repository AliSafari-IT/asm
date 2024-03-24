{{-- resources/views/livewire/edit-model-instance.blade.php --}}
<div class="max-w-4xl mx-auto py-10">
    @if (session()->has('message'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
            {{ session('message') }}
        </div>
    @endif

    <form wire:submit.prevent="save" class="space-y-8">
        @foreach ($fields as $field => $options)
            @php
                $inputType = $options['type'] ?? 'text';
                $label = $options['label'] ?? ucfirst($field);
                $value = $data[$field] ?? '';
            @endphp

            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2 capitalize">{{ $label }}</label>
                
                @if ($inputType === 'textarea')
                    <textarea name="data[{{ $field }}]"
                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                        wire:model.defer="data.{{ $field }}"></textarea>
                @elseif ($inputType === 'checkbox')
                    <input type="checkbox" class="form-checkbox h-5 w-5 text-gray-600"
                        wire:model.defer="data.{{ $field }}" {{ $value ? 'checked' : '' }}>
                @else
                    <input type="{{ $inputType }}"
                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline {{ $field === 'id' ? 'bg-gray-100 disabled' : '' }}"
                        wire:model.defer="data.{{ $field }}" {{ $field === 'id' ? 'disabled' : '' }}>
                @endif

                @error('data.' . $field) 
                    <span class="text-red-500 text-xs italic">{{ $message }}</span> 
                @enderror
            </div>
        @endforeach

        <div class="flex items-center justify-between">
            <a href="{{ url()->previous() }}"
                class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">Back</a>
            <button type="submit"
                class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                Save
            </button>
        </div>
    </form>
</div>
