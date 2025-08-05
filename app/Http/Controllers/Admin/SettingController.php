<?php

namespace App\Http\Controllers\Admin;

use App\Models\Setting;
use Illuminate\Http\Request;
use SweetAlert2\Laravel\Swal;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Log;

class SettingController extends Controller
{
    private $model;

    public function __construct(Setting $model)
    {
        $this->model = $model;
    }

    public function form()
    {
        $settings = $this->model::first();
        $breadcrumbs = [
            ['name' => __('lang.home'), 'href' => route('home')],
            ['name' => 'Sozlamalar', 'href' => route('admin.settings')],
        ];
        return view('admin.pages.settings', compact('settings', 'breadcrumbs'));
    }

    public function post(Request $request, $id = null)
    {
        $data = $this->model::first();
        try {
            $fd = $request->all();
            if ($request->hasFile('logo') && $request->file('logo')->isValid()) {
                $logoPath = $request->file('logo')->store('company', 'public');
                $fd['logo'] = $logoPath;
            } elseif ($data) {
                // Rasm yuborilmasa va bu update bo‘lsa — eski rasmni saqlab qolamiz
                $fd['logo'] = $data->logo;
            }
            $data->update($fd);
            Swal::fire([
                'position' => "center",
                'icon' => "success",
                'title' => "Sozlamalar yangilandi",
                'showConfirmButton' => false,
                'timer' => 2000
            ]);
            Log::error('gfhjgfh');
        } catch (\Exception $e) {
            Log::error('afsdf');
            Swal::fire([
                'position' => "center",
                'icon' => "warning",
                'title' => "Sozlamalar yangilanmadi",
                'showConfirmButton' => false,
                'timer' => 2000
            ]);
            return redirect()->back()->with('error', $e->getMessage())->withInput();
        }
        $breadcrumbs = [
            ['name' => __('lang.home'), 'href' => route('home')],
            ['name' => 'Sozlamalar', 'href' => route('admin.settings')],
        ];
        return redirect()->route('admin.settings', ['id' => $data->id])->with('success', 'Успешно сохранено');
    }
}
