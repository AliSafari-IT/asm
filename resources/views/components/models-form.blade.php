<div class="container mx-auto px-4">

    <!-- Simplicity is the essence of happiness. - Cedric Bledsoe -->
    <form method="POST"
        action="{{ $actionType == 'create' ? route($model::getRouteName().'.store') : route($model::getRouteName().'.update', ['id' => $model->id]) }}">
        @csrf
        @if($actionType !== 'create')
        @method('PUT')
        @endif

        @foreach($fields as $fieldName => $options)
        <label for="{{ $fieldName }}">{{ $options['label'] ?? ucfirst($fieldName) }}</label>
        <input type="{{ $options['type'] ?? 'text' }}" name="{{ $fieldName }}" id="{{ $fieldName }}"
            value="{{ old($fieldName, $model ? $model->$fieldName : '') }}">
        @endforeach

        <button type="submit">{{ $actionType == 'create' ? 'Create' : 'Update' }}</button>
    </form>

    @if($model)
        @php
        $modelName = strtolower(class_basename($model));
        $routeName = "{$modelName}s.destroy"; // Assuming your route names follow a {model}s.destroy pattern
        $routeParam = [$modelName => $model->id];
        @endphp

        <form method="POST" action="{{ route($routeName, $routeParam) }}">
            @csrf
            @method('DELETE')
            <button type="submit">Delete</button>
        </form>

    @endif
</div>