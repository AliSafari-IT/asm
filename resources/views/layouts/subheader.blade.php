@props([
    'title',
    'description' => null, // Default to null if not provided
    'actions' => null, // Default to null if not provided
    'containerClasses' => '', // Provide default empty string
    'titleClasses' => '',
    'descriptionClasses' => '',
    'actionsClasses' => ''
])

<div {{ $attributes->merge(['class' => "bg-blue-900 text-white py-4 $containerClasses"]) }}>
    <div class="container mx-auto flex justify-between items-center">
        <div>
            <h1 class="text-2xl font-semibold {{ $titleClasses }}">{{ $title }}</h1>
            @if($description)
                <p class="text-sm {{ $descriptionClasses }}">{{ $description }}</p>
            @endif
        </div>
        @if($actions)
        <div class="{{ $actionsClasses }}">
            {{ $actions }}
        </div>
        @endif
    </div>
</div>
