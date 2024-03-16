<x-app-layout>
    <div>    
        @php 
        $newModel = new \App\Models\User();

        @endphp
    @livewire('create-new-instance', [ 'instanceModel' => $newModel,'modelType' => 'User']);
    </div>
</x-app-layout>