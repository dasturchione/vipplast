<?php

namespace App\Http\Controllers\Admin;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Services\CrudService;
use App\Http\Services\FileService;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    private $model;

    public function __construct(Product $model)
    {
        $this->model = $model;
    }

    public function index(Request $request)
    {
        $data =  $this->model::orderBy('id', 'desc')->paginate(15);
        return view('admin.pages.product.index', compact('data'));
    }

    public function form(Request $request, $action, $id = null)
    {
        if ($id) {
            $item = $this->model::findOrFail($id);
            $item->image = $item->image ? asset('storage/' . $item->image) : null;
        } else {
            $item = null;
        }

        $pcatecory = Category::where('parent_id', null)->get();

        $breadcrumbs = [
            ['name' => __('lang.home'), 'href' => route('home')],
            ['name' => "Mahsulotlar", 'href' => route('admin.products')],
            ['name' => $action === 'create' ? __('lang.create') : __('lang.edit'), 'href' => route('admin.products')],
        ];

        if ($request->ajax()) {
            return Category::where('parent_id', $request->parent_id)->get(['id', 'name']);
        }

        return view('admin.pages.product.form', compact('item', 'action', 'breadcrumbs', 'pcatecory'));
    }

    public function post(Request $request, $id = null)
    {
        $isUpdate = !is_null($id);
        $request->validate($this->model::rules($isUpdate));

        try {
            $data = $request->all();

            if ($id) {
                $product = $this->model::findOrFail($id);
            } else {
                $product = null;
            }

            // Agar yangi rasm kelgan bo‘lsa, yuklaymiz
            if ($request->hasFile('image') && $request->file('image')->isValid()) {
                $imagePath = $request->file('image')->store('product', 'public');
                $data['image'] = $imagePath;
            } elseif ($product) {
                // Rasm yuborilmasa va bu update bo‘lsa — eski rasmni saqlab qolamiz
                $data['image'] = $product->image;
            }

            if ($product) {
                $product->update($data);
            } else {
                $product = $this->model::create($data);
            }
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', $e->getMessage())
                ->withInput();
        }

        return redirect()->route('admin.products')->with('success', 'Успешно сохранено');
    }


    public function destroy($id)
    {
        $product = $this->model::findOrFail($id);

        // Rasm borligini va mavjudligini tekshirish
        if ($product->image && Storage::exists('public/' . $product->image)) {
            Storage::delete('public/' . $product->image);
        }

        $product->delete();

        return redirect()->back()->with('success', 'Mahsulot o`chirildi');
    }
}
