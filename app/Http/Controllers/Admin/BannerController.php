<?php

namespace App\Http\Controllers\Admin;

use App\Models\Banner;
use Illuminate\Http\Request;
use App\Http\Services\CrudService;
use App\Http\Services\FileService;
use App\Http\Controllers\Controller;
use App\Http\Resources\BannerResource;
use Illuminate\Support\Facades\Storage;

class BannerController extends Controller
{
    private $model;

    public function __construct(Banner $model)
    {
        $this->model = $model;
    }

    public function index(Request $request)
    {
        $data =  $this->model::paginate(15);
        $breadcrumbs = [
            ['name' => __('lang.home'), 'href' => route('home')],
            ['name' => __('lang.banners'), 'href' => route('admin.banners')],
        ];
        return view('admin.pages.banner.index', compact('data', 'breadcrumbs'));
    }

    public function form($action, $id = null)
    {
        if ($id) {
            $item = $this->model::findOrFail($id);
            $item->image = $item->image ? asset('storage/' . $item->image) : null;
        } else {
            $item = null;
        }

        $breadcrumbs = [
            ['name' => __('lang.home'), 'href' => route('home')],
            ['name' => __('lang.banners'), 'href' => route('admin.banners')],
            ['name' => $action === 'create' ? __('lang.create') : __('lang.edit'), 'href' => route('admin.banners')],
        ];

        return view('admin.pages.banner.form', compact('item', 'action', 'breadcrumbs'));
    }

    public function post(Request $request, $id = null)
    {
        $isUpdate = !is_null($id);
        $request->validate($this->model::rules($isUpdate));

        try {
            $data = $request->all();

            if ($id) {
                $banner = $this->model::findOrFail($id);
            } else {
                $banner = null;
            }

            // Agar yangi rasm kelgan bo‘lsa, yuklaymiz
            if ($request->hasFile('image') && $request->file('image')->isValid()) {
                $imagePath = $request->file('image')->store('banners', 'public');
                $data['image'] = $imagePath;
            } elseif ($banner) {
                // Rasm yuborilmasa va bu update bo‘lsa — eski rasmni saqlab qolamiz
                $data['image'] = $banner->image;
            }

            if ($banner) {
                $banner->update($data);
            } else {
                $banner = $this->model::create($data);
            }
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage())->withInput();
        }

        return redirect()->route('admin.banners')->with('success', 'Успешно сохранено');
    }

    public function destroy($id)
    {
        $banner = $this->model::findOrFail($id);

        // Rasm borligini va mavjudligini tekshirish
        if ($banner->image && Storage::exists('public/' . $banner->image)) {
            Storage::delete('public/' . $banner->image);
        }

        $banner->delete();

        return redirect()->back()->with('success', 'Баннер успешно удалено');
    }
}
