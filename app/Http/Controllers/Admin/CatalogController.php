<?php

namespace App\Http\Controllers\Admin;

use App\Models\Catalog;
use Illuminate\Http\Request;
use SweetAlert2\Laravel\Swal;
use App\Http\Controllers\Controller;

class CatalogController extends Controller
{
    private $model;

    public function __construct(Catalog $model)
    {
        $this->model = $model;
    }

    public function index()
    {
        $catalogs = $this->model::orderBy('sort', 'asc')->get();

        return view('admin.pages.catalog.index', compact('catalogs'));
    }

    public function post(Request $request)
    {
        $request->validate($this->model::rules());

        try {
            $data = $request->all();

            // Agar yangi rasm kelgan bo‘lsa, yuklaymiz
            if ($request->hasFile('image') && $request->file('image')->isValid()) {
                $imagePath = $request->file('image')->store('catalog', 'public');
                $data['image'] = $imagePath;
            }
            $catalog = $this->model::create($data);

            Swal::fire([
                'position' => "center",
                'icon' => "success",
                'title' => "Katalog qo`shildi",
                'showConfirmButton' => false,
                'timer' => 3000
            ]);
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage())->withInput();
        }

        return redirect()->route('admin.catalogs')->with('success', 'Успешно сохранено');
    }

    public function sort(Request $request)
    {
        foreach ($request->input('items', []) as $item) {
            $this->model::where('id', $item['id'])
                ->update(['sort' => $item['sort']]);
        }
        return response()->json(['message' => 'Tartib yangilandi']);
    }

    public function destroy($id)
    {
        $catalog = $this->model::findOrFail($id);

        $catalog->delete();

        return redirect()->back()->with('success', 'успешно удалено');
    }
}
