<?php

namespace App\Controllers\Admin;

use App\Models\Category;
use App\Controllers\Controller;
use App\Utilities\Helpers\CSRFToken;
use App\Utilities\Helpers\Redirect;
use App\Utilities\Helpers\Request;
use App\Utilities\Session\SessionManager;
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
                Category::create([
                    'name' => $request->name,
                    "slug" => slugify($request->name)
                ]);
                return Redirect::to('/admin/categories');
            }
            throw new Exception('Token mismatch');
        }
    }
}
