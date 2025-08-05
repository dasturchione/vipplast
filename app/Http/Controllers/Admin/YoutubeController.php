<?php

namespace App\Http\Controllers\Admin;

use App\Models\YoutubeBlog;
use Illuminate\Http\Request;
use SweetAlert2\Laravel\Swal;
use App\Http\Controllers\Controller;

class YoutubeController extends Controller
{
    private $model;

    public function __construct(YoutubeBlog $model)
    {
        $this->model = $model;
    }

    public function index()
    {
        $data = $this->model::orderBy('created_at', 'desc')->paginate(10);
        return view('admin.pages.ytblog.index', compact('data'));
    }

    public function form($action, $id = null)
    {
        if ($id) {
            $item = $this->model::findOrFail($id);
        } else {
            $item = null;
        }

        $breadcrumbs = [
            ['name' => __('lang.home'), 'href' => route('home')],
            ['name' => 'Video blog', 'href' => route('admin.ytblog')],
            ['name' => $action === 'create' ? __('lang.create') : __('lang.edit'), 'href' => route('admin.ytblog')],
        ];

        return view('admin.pages.ytblog.form', compact('item', 'action', 'breadcrumbs'));
    }

    public function post(Request $request, $id = null)
    {
        $isUpdate = !is_null($id);
        $request->validate($this->model::rules($isUpdate));

        try {
            $data = $request->all();

            if ($id) {
                $ytblog = $this->model::findOrFail($id);
            } else {
                $ytblog = null;
            }

            if ($ytblog) {
                $ytblog->update($data);
                Swal::fire([
                    'position' => "center",
                    'icon' => "success",
                    'title' => "Video blog yangilandi",
                    'showConfirmButton' => false,
                    'timer' => 2000
                ]);
            } else {
                Swal::fire([
                    'position' => "center",
                    'icon' => "success",
                    'title' => "Video blog qo`shildi",
                    'showConfirmButton' => false,
                    'timer' => 2000
                ]);
                $ytblog = $this->model::create($data);
            }
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage())->withInput();
        }

        return redirect()->route('admin.ytblog')->with('success', 'Успешно сохранено');
    }

    public function destroy($id)
    {
        $ytblog = $this->model::findOrFail($id);
        $ytblog->delete();
        Swal::fire([
            'position' => "center",
            'icon' => "success",
            'title' => "Video blog o`chirildi",
            'showConfirmButton' => false,
            'timer' => 3000
        ]);
        return redirect()->back();
    }
}
