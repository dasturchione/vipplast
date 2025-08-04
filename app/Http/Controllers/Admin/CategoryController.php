<?php

namespace App\Http\Controllers\Admin;

use App\Models\Category;
use Illuminate\Http\Request;
use SweetAlert2\Laravel\Swal;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Log;

class CategoryController extends Controller
{
    private $model;

    public function __construct(Category $model)
    {
        $this->model = $model;
    }

    public function index(Request $request)
    {
        $data =  $this->model::getCategoryTree();
        return view('admin.pages.category.index', compact('data'));
    }

    public function post(Request $request, $id = null)
    {
        $isUpdate = !is_null($id);

        try {
            $request->validate($this->model::rules($isUpdate));
            Log::error('Validated data:', $request->all());

            $data = $request->all();
            $category = $id ? $this->model::findOrFail($id) : null;

            if ($request->hasFile('image') && $request->file('image')->isValid()) {
                $imagePath = $request->file('image')->store('category', 'public');
                $data['image'] = $imagePath;
            } elseif ($category) {
                $data['image'] = $category->image;
            }

            if ($category) {
                $category->update($data);
            } else {
                $category = $this->model::create($data);
            }
            Swal::fire([
                'position' => "center",
                'icon' => "success",
                'title' => "Kategoriya qo`shildi",
                'showConfirmButton' => false,
                'timer' => 3000
            ]);
            return redirect()->route('admin.categories')->with('success', 'Успешно сохранено');
        } catch (\Exception $e) {
            Swal::fire([
                'position' => "center",
                'icon' => "warning",
                'title' => "Kategoriya qo`shilmadi",
                'showConfirmButton' => false,
                'timer' => 3000
            ]);
            Log::error('Xatolik:', ['message' => $e->getMessage(), 'trace' => $e->getTraceAsString()]);
            return redirect()->back()->with('error', 'Xatolik yuz berdi: ' . $e->getMessage())->withInput();
        }
    }

    public function update(Request $request)
    {
        $data = $request->input('nestable');
        if ($data) {
            $array = json_decode($data);
            $this->recursion($array);
        }

        Swal::fire([
            'position' => "center",
            'icon' => "success",
            'title' => "Kategoriya yangilandi",
            'showConfirmButton' => false,
            'timer' => 1500
        ]);

        return redirect()->back()->with('success', 'Успешно обновлено');
    }

    private function recursion($array, $parent_id = null)
    {
        if (count($array)) {
            $i = 1;
            foreach ($array as $arr) {
                $this->model->where('id', $arr->id)->update(['sort' => $i, 'parent_id' => $parent_id]);
                if (isset($arr->children)) {
                    $this->recursion($arr->children, $arr->id);
                }
                $i++;
            }
        }
    }

    public function childCategory($parentid)
    {
        $children = $this->model::where('parent_id', $parentid)->get(['id', 'name_uz']);
        return response()->json($children);
    }

    public function destroy($id)
    {
        $this->model::findOrFail($id)->delete();
        Swal::fire([
            'position' => "center",
            'icon' => "success",
            'title' => "Kategoriya o`chirildi",
            'showConfirmButton' => false,
            'timer' => 1500
        ]);
        return redirect()->back()->with('success', 'Успешно удалено');
    }
}
