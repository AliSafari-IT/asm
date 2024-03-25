<x-app-layout>
                        @php
                        $modelType = class_basename($model);
                        $modelId = $model->id;
                        $tableName = strtolower(Str::plural($modelType));
                        @endphp
                        <div>
                            @livewire('display-model-instance', ['instanceModel' => $model, 'modelType' => $modelType, 'modelId' =>
                            $modelId, 'tableName' => $tableName])
                        </div>
                    </x-app-layout>
