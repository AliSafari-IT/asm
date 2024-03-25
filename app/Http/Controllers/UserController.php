<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public $model = User::class;
    public $rootFolder = '';
    public $tableName = 'users';
    public $viewFolder;
    public $models;

    public function __construct()
    {
        $this->middleware('auth');
        $this->models = $this->model::all();
        $this->viewFolder = $this->rootFolder . '.' . $this->tableName;
    }
    public function index()
    {
        // viewPath
        $viewPath = $this->viewFolder . '.' . __FUNCTION__;
        $models = $this->models;
        return view($viewPath, compact('models'));
    }
    public function show($model)
    {
        if (is_numeric($model)) {
            $model = $this->model::findOrFail($model);
        }
        // viewPath
        $viewPath = $this->viewFolder . '.' . __FUNCTION__;
        return view($viewPath, compact('model'));
    }

    public function create()
    {
        // viewPath
        $viewPath = $this->viewFolder . '.' . __FUNCTION__;
        return view($viewPath);
    }

    public function store(Request $request)
    {

        $validatedData =   $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
        

        if ($validatedData['password'] != $validatedData['password_confirm']) {
            return redirect()->back()->with('error', 'Passwords do not match.');
        }


        

        $modelData = $request->all();
        $modelData['password'] = Hash::make($modelData['password']);

        unset($modelData['password_confirm']); // Remove password_confirm as it's not needed for storage

        $model = $this->model::create($modelData);

        $routeName = $this->tableName . '.show';
        return redirect()->route($routeName, $model)->with('success', class_basename($model) . ' created successfully.');
    }

    public function save(Request $request)
    {
        $model = $this->model::create($request->all());
        $routeName = $this->tableName . '.show';
        return redirect()->route($routeName, $model)->with('success', class_basename($model) . ' created successfully.');
    }

    public function edit(Request $request, $id)
    {
        // Attempt to find the model instance
        try {
            $model = $this->model::findOrFail($id);
        } catch (ModelNotFoundException $e) {
            abort(404, 'Model not found.');
        }
        // viewPath
        $viewPath = $this->viewFolder . '.' . __FUNCTION__;
        return view($viewPath, ['model' => $model]);
    }

    public function update(Request $request, $id)
    {

        $model = $this->model::findOrFail($id);
        $model->update($request->all());
        $routeName = $this->tableName . '.show';

        return redirect()->route($routeName, $model)->with('success', class_basename($model) . ' updated successfully.');
    }

    public function destroy($id)
    {
        $model = $this->model::findOrFail($id);
        $model->delete();
        $routeName = $this->tableName . '.index';
        return redirect()->route($routeName)->with('success', 'Article deleted successfully.');
    }

}