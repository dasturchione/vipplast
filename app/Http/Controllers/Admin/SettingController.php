<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Services\CrudService;
use App\Http\Services\FileService;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\File;

class SettingController extends Controller
{
    private $model;
    private $fileService;
    private $crudService;

    public function __construct(Setting $model, FileService $fileService, CrudService $crudService)
    {
        $this->model = $model;
        $this->fileService = $fileService;
        $this->crudService = $crudService;
    }

    public function form()
    {
        $data = $this->model::first();

        if (!$data) {
            $data = new $this->model;
        }

        return view('admin.setting.form', compact('data'));
    }

    public function post(Request $request, $id = null)
    {
        $data = $this->model::first();

        try {

            $fd = $request->all();

            if ($request->hasFile('catalog')) {
                $file = $request->file('catalog');
                $extension = strtolower($file->getClientOriginalExtension());
                if (!in_array($extension, ["pdf"])) {
                    throw new \Exception('Файл должен быть файлом типа: pdf' );
                }
                $destinationPath = 'storage/files';
                $file->move($destinationPath, 'catalog.'.$extension);

                $fd = array_merge($request->all(), ['catalog' => $destinationPath.'/catalog.'.$extension]);
            }

            $data->update($fd);

            Cache::forget('settings');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage())->withInput();
        }

        return redirect()->route('admin.setting.form', ['id' => $data->id])->with('success', 'Успешно сохранено');
    }
}
