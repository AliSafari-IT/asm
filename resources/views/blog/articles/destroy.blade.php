<!-- destroy.blade.php -->
                <x-app-layout>
                    <div>
                        @livewire('delete-model-instance', ['modelType' => 'articles', 'modelId' => $modelId])
                    </div>
                </x-app-layout>
