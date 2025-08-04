<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Services\CrudService;
use App\Models\Category;
use App\Models\Product;
use App\Models\Seo;
use Illuminate\Http\Request;

class MetaController extends Controller
{
    private $model;
    private $crudService;

    public function __construct(Seo $model, CrudService $crudService)
    {
        $this->model = $model;
        $this->crudService = $crudService;
    }

    public function index(Request $request)
    {
        $data =  $this->model::filter($request->input())->paginate(15);
        return view('admin.meta.index', compact('data'));
    }

    public function categoryForm($category_id)
    {
        $category = Category::with('meta')->where('id', $category_id)->first();
        return view('admin.meta.category-form', compact('category'));
    }

    public function categoryPost(Request $request, $category_id)
    {
        $meta = Seo::where('category_id', $category_id)->first();

        $data = $request->all();
        $data['category_id'] = $category_id;

        if ($meta instanceof Seo) {
            $meta->update($data);
        } else {
            Seo::create($data);
        }

        return redirect()->route('admin.category.index')->with('success', 'Успешно сохранено');
    }

    public function productForm($product_id)
    {
        $model = Product::with('meta')->where('id', $product_id)->first();
        return view('admin.meta.product-form', compact('model'));
    }

    public function productPost(Request $request, $product_id)
    {
        $meta = Seo::where('product_id', $product_id)->first();

        $data = $request->all();
        $data['product_id'] = $product_id;

        if ($meta instanceof Seo) {
            $meta->update($data);
        } else {
            Seo::create($data);
        }

        $page = $request->page ?? '1';

        return redirect()->route('admin.product.index', ['page' => $page])->with('success', 'Успешно сохранено');
    }
}
