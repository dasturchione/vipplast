<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Services\CrudService;
use App\Http\Services\FileService;
use App\Models\Page;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PageController extends Controller
{
    private $model;
    private $fileService;
    private $crudService;

    public function __construct(Page $model, FileService $fileService, CrudService $crudService)
    {
        $this->model = $model;
        $this->fileService = $fileService;
        $this->crudService = $crudService;
    }

    public function index(Request $request)
    {
        $data =  $this->model::filter($request->input())->paginate(15);
        return view('admin.page.index', compact('data'));
    }

    public function form($id = null)
    {
        if ($id) {
            $data = $this->model::findOrFail($id);
        } else {
            $data = $this->model;
        }

        return view('admin.page.form', compact('data'));
    }

    public function post(Request $request, $id = null)
    {
        try {
            $dataReq = $request->all();

            // get files
            $files = $request->files->all();

            $data = new $this->model;

            if ($id) {
                $data = $this->model::findOrFail($id);
                $data->update($dataReq);
            } else {
                $data = $data->create($dataReq);
            }

            // uploadBody
            if ($request->has('body_ru')) {
                $data->update([
                    'body_ru' => $data->handleUploadedBody($request->get('body_ru'), ['1280','720']),
                    'body_uz' => $data->handleUploadedBody($request->get('body_uz'), ['1280','720'])
                ]);
            }

            // applyImages
            $uploadedImages = $this->applyImages($data, $files, []);
            if (!empty($uploadedImages)) {
                $data->update($uploadedImages);
            }

            DB::commit();
        } catch (\Exception $exception) {
            DB::rollBack();
            return redirect()->back()->with('error', $exception->getMessage())->withInput();
        }

        return redirect()->route('admin.page.index')->with('success', 'Успешно сохранено');
    }

    private function applyImages($model, $files, $noChangedGallery = [])
    {
        $new_data = [];
        if (count($files) > 0) {
            foreach ($files as $key => $file) {
                if (is_array($file)) {
                    foreach ($file as $f) {
                        $noChangedGallery[] = $this->fileService->uploadImage($f, $model, $key, true);
                    }
                    $new_data[$key] = json_encode($noChangedGallery);
                } else {
                    $new_data[$key] = $this->fileService->uploadImage($file, $model, $key, false);
                }
            }
        }
        return $new_data;
    }

    public function destroy($id)
    {
        $this->model::findOrFail($id)->delete();
        return redirect()->back()->with('success', 'Успешно удалено');
    }
}
