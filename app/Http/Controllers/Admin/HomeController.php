<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\RegosSync;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function home()
    {
        return view('admin.home');
    }

    public function destroyImage(Request $request)
    {
        if ($request->ajax()) {
            $path = str_replace('/storage', 'storage', $request->get('path'));
            $thumb_path = str_replace('.', '_thumb.', $path);
            $medium_path = str_replace('.', '_medium.', $path);
            $large_path = str_replace('.', '_large.', $path);
            $original_path = str_replace('.', '_original.', $path);

            @unlink($thumb_path);
            @unlink($medium_path);
            @unlink($large_path);
            @unlink($original_path);
        }
        return response()->json(['success'=>true]);
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('home');
    }
}
