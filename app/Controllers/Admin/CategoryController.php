<?php

namespace App\Controllers\Admin;

use App\Models\Category;
use App\Controllers\Controller;
use App\Utilities\Helpers\CSRFToken;
use App\Utilities\Helpers\Redirect;
use App\Utilities\Helpers\Request;
use App\Utilities\Helpers\RequestValidator;
use App\Utilities\Session\SessionManager;
use illuminate\Support\Collection;
use Exception;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::all()->sortByDesc('created_at');
        return view('admin.category.index', compact('categories'));
    }

    public function store()
    {
        if (Request::has('post')) {
            $request = Request::get('post');

            if (CSRFToken::verifyCSRFToken($request->token, false)) {
                $rules = [
                    'name' => ['required' => true, 'string' => true, 'maxLength' => 20, 'unique' => 'categories']
                ];
                $validate  = new RequestValidator;
                $validate->abide((array) $request, $rules);

                if ($validate->hasError()) {
                    $errors = [];
                    foreach ($validate->getErrorMessages() as $key => $value) {
                        if (is_array($value)) {
                            $errors[$key] = $value[0];
                        }
                    }
                    header('Content-Type: application/json');
                    header('HTTP/1.1 422 Unprocessable Entity', true, 422);
                    echo json_encode(['status' => 422, 'errors' => $errors]);
                    exit;
                }

                Category::create([
                    'name' => ucfirst($request->name),
                    "slug" => slugify($request->name)
                ]);
                header('Content-Type: application/json');
                header('HTTP/1.1 201 Resource created', true, 201);
                $response = ['message' => 'success', 'status' => 201];
                echo json_encode($response);
                exit;
            }
            throw new Exception('Token mismatch');
        }
    }

    public function update($id)
    {
        if (Request::has('post')) {
            $request = Request::get('post');

            if (CSRFToken::verifyCSRFToken($request->token, false)) {
                $rules = [
                    'name' => ['required' => true, 'string' => true, 'maxLength' => 20, 'unique' => 'categories']
                ];
                $validate  = new RequestValidator;
                $validate->abide((array) $request, $rules);

                if ($validate->hasError()) {
                    $errors = [];
                    foreach ($validate->getErrorMessages() as $key => $value) {
                        if (is_array($value)) {
                            $errors[$key] = $value[0];
                        }
                    }
                    header('Content-Type: application/json');
                    header('HTTP/1.1 422 Unprocessable Entity', true, 422);
                    echo json_encode(['status' => 422, 'errors' => $errors]);
                    exit;
                }
                Category::where('id', $id)->update(['name' => $request->name, 'slug' => slugify($request->name)]);
                header('Content-Type: application/json');
                header('HTTP/1.1 200 Resource created', true, 200);
                $response = ['message' => 'Record updated', 'status' => 200];
                echo json_encode($response);
                exit;
            }
            throw new Exception('Token mismatch');
        }
    }
}
