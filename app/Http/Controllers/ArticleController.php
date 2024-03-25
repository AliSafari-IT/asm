<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View as ViewFacade;
use Illuminate\Support\Str;
use ReflectionClass;

class ArticleController extends Controller
{

    public $model = Article::class;
    public $rootFolder = 'blog';
    public $tableName = 'articles';
    public $viewFolder;
    public $models ;

    public function __construct()
    {
        $this->middleware('auth');
        $this->models =  $this->model::all();
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
