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
        $categories = Category::all();
        return view('admin.category.index', compact('categories'));
    }

    public function store()
    {
        if (Request::has('post')) {
            $request = Request::get('post');


            if (CSRFToken::verifyCSRFToken($request->token)) {
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
                    http_response_code(400);
                    echo json_encode($errors);
                    exit;
                }

                Category::create([
                    'name' => ucfirst($request->name),
                    "slug" => slugify($request->name)
                ]);
                return json_encode(['message' => 'sucess']);
            }
            throw new Exception('Token mismatch');
        }
    }
}
