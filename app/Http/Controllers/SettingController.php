<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View as ViewFacade;
use Illuminate\Support\Str;
use ReflectionClass;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class SettingController extends Controller
{
    public function show($model)
    {
        if (is_numeric($model)) {
            $model = Setting::findOrFail($model);
        }
        $tableName = strtolower(Str::plural(class_basename($model)));
        $viewName = 'blog.' . $tableName . '.show';
        return view($viewName, compact('model'));
    }


    public function edit(Request $request, $id)
    {
        // Extract the name of the model from this controller class name (e.g., "PostController" => "Post")
        $controllerClassName = get_class($this); // Gets the full class name of the current controller instance
        $shortClassName = (new ReflectionClass($this))->getShortName(); // Extracts the short class name
        $modelName = str_replace('Controller', '', $shortClassName); // Removes "Controller" from the class name
        $tableName = strtolower(Str::plural(class_basename($modelName))); // Converts model name to table name format
        $className = 'App\\Models\\' . $modelName; // Assumes models are stored in the "App\Models" namespace
        // Attempt to find the model instance
        try {
            $model = $className::findOrFail($id);
        } catch (ModelNotFoundException $e) {
            abort(404, 'Model not found.');
        }

        // Construct the base view path
        $viewPath = strtolower(Str::plural($modelName)) . '.edit';

        // Check if the view exists, if not prepend 'blog.'
        if (!ViewFacade::exists($viewPath)) {
            $viewPath = 'blog.' . $viewPath;
        }

        // Ensure the view exists now, or throw an exception
        if (!ViewFacade::exists($viewPath)) {
            abort(404, "View [{$viewPath}] not found.");
        }

        return view($viewPath, ['model' => $model]);
    }

    public function store(Request $request, $id)
    {
        $setting = \App\Models\Setting::findOrFail($id);
        $setting->update($request->all());
        return redirect()->route('blog.settings.show', $setting->id)->with('success', 'Setting updated successfully.');
    }

    public function index()
    {
        $settings = Setting::all();
        return view('blog.settings.index', compact('settings'));
    }

    public function create()
    {
        return view('blog.settings.create');
    }

    public function update(Request $request, $id)
    {
        // Extract the name of the model from this controller (this controller class name) (eg. PostController => Post)
        $controllerClassName = get_class($this); // Gets the full class name of the current controller instance
        // Extract the short class name from the full class name (in case of namespaces)
        $shortClassName = (new ReflectionClass($this))->getShortName();
        // Assuming the convention that controller names are the model names followed by "Controller"
        $modelName = str_replace('Controller', '', $shortClassName);
        $tableName = strtolower(Str::plural(class_basename($modelName)));
        $className = 'App\Models\\' . $modelName;
        $model = $className::findOrFail($id);
        $data = $request->all();
        $model->update($data);

        $routeName = $tableName . '.show';

        return redirect()->route($routeName, $model)->with('success', class_basename($model) . ' updated successfully.');
    }

    public function destroy($id)
    {
        $setting = Setting::findOrFail($id);
        $setting->delete();
        return redirect()->route('blog.settings.index')->with('success', 'Setting deleted successfully.');
    }

    private function getModelNameFromController(): string
    {
        $controllerClassName = get_class($this);
        $shortClassName = (new ReflectionClass($this))->getShortName();
        return str_replace('Controller', '', $shortClassName);
    }

}
