<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Permission; // for Permission model
use ReflectionClass;
use Illuminate\Support\Facades\View as ViewFacade;
use Illuminate\Database\Eloquent\ModelNotFoundException;
class PermissionController extends Controller
{
    /**
     * Display a listing of the permissions.
     */
    public function index()
    {
        $permissions = Permission::all();
        return view('permissions.index', compact('permissions'));
    }

    /**
     * Display the specified permission.
     */
    public function show($model)
    {
        if (is_numeric($model)) {
            $model =Permission::findOrFail($model);
        }
        $tableName = strtolower(Str::plural(class_basename($model)));
        $viewName = $tableName . '.show';
        return view($viewName, compact('model'));
    }

    /**
     * Show the form for creating a new permission.
     */
    public function create()
    {
        return view('permissions.create');
    }

    /**
     * Store a newly created permission in the database.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|unique:permissions|max:255',
            'description' => 'nullable|max:255',
        ]);

        $validatedData['slug'] = strtolower($validatedData['name']);

        if (isset($validatedData['permissions'])) {
            $validatedData['permissions'] = json_encode($validatedData['permissions']);
        }

        $permission = Permission::create($validatedData);

        return redirect()->route('permissions.index')->with('success', 'Permission created successfully.');
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
        $model->update($request->all());
        $routeName = $tableName . '.show';

        return redirect()->route($routeName, $model)->with('success', class_basename($model) . ' updated successfully.');
    }


    /**
     * Remove the specified permission from the database.
     */
    public function destroy($id)
    {
        $permission = Permission::findOrFail($id);
        $permission->delete();
        return redirect()->route('permissions.index')->with('success', 'Permission deleted successfully.');
    }
}

