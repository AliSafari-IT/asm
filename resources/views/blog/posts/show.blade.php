<x-app-layout>
    @php
        $modelType = 'Post';
        $modelId = $post->id;
    @endphp
    <div>       
        @livewire('display-model-instance', [
            'instanceModel' => $post, 
            'modelType' => $modelType, 
            'modelId' => $modelId
        ])
    </div>    
</x-app-layout>
