<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    private $model;

    public function __construct(User $model)
    {
        $this->model = $model;
    }

    public function index(Request $request)
    {
        $data = $this->model::orderBy('created_at', 'desc')->paginate(20);
        return view('admin.pages.user.index', compact('data'));
    }


    public function post(Request $request, $id = null)
    {
        $isUpdate = $id !== null;

        $rules = [
            'name' => 'required|string|max:255',
            'surname' => 'nullable|string|max:255',
            'email' => [
                $isUpdate ? 'nullable' : 'required',
                'email',
                Rule::unique('users', 'email')->ignore($id)
            ],
            'password' => $isUpdate ? 'nullable' : 'required|min:6',
            'status' => 'required|boolean',
        ];

        $validated = $request->validate($rules);

        if (!empty($validated['password'])) {
            $validated['password'] = bcrypt($validated['password']);
        } else {
            unset($validated['password']);
        }

        try {
            $user = $isUpdate
                ? tap($this->model::findOrFail($id))->update($validated)
                : $this->model::create($validated);
        } catch (\Exception $e) {
            throw new \DomainException('Xatolik yuz berdi: ' . $e->getMessage(), $e->getCode());
        }

        return redirect()->back()->with('success', 'Ma\'lumotlar muvaffaqiyatli saqlandi!');
    }
}
