<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Feedback;
use App\Models\Product;
use Illuminate\Http\Request;

class FeedbackController extends Controller
{
    private $model;

    public function __construct(Feedback $model)
    {
        $this->model = $model;
    }

    public function index(Request $request)
    {
        $data =  $this->model::orderBy('created_at', 'DESC')->paginate(15);
        return view('admin.pages.feedback', compact('data'));
    }

    public function markAsRead(Request $request)
    {
        $data = $this->model::findOrFail($request->id);
        if ($data->view == 0) {
            $data->view = 1;
            $data->save();
        }
        return true;
    }

    public function destroy($id)
    {
        $this->model::findOrFail($id)->delete();
        return redirect()->back()->with('success', 'Успешно удалено');
    }
}
