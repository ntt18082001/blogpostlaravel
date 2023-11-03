<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Repositories\Category\CategoryRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class CategoryController extends BaseController
{
    protected $cateRepo;
    public function __construct(CategoryRepositoryInterface $cateRepo) {
        $this->cateRepo = $cateRepo;
    }
    function index(Request $request) {
        $cate_name = isset($request->cate_name) ? $request->cate_name : false;
        if($cate_name) {
            $result = $this->cateRepo->searchCategory($cate_name)->paginate();
        } else {
            $result = $this->cateRepo->getAllWith(['id', 'cate_name', 'description'])->paginate();
        }
        return view('Admin.category.index')->with('data', $result);
    }
    function create() {
        return view('Admin.category.create');
    }
    function save(Request $request, $id = null) {
        $data = $request->all();
        $this->customValidate($data);
        try {
            $this->cateRepo->updateOrCreate($data, $id);
            return redirect()->route('admin.category.index')->with('success-msg', "Category created!");
        } catch (\ErrorException $exception) {
            return redirect()->route('admin.category.index')->with('error-msg', self::ERROR_MSG);
        }
    }
    private function customValidate($data) {
        $rules = [
            "cate_name" => ['required'],
            "description" => ['required',],
        ];
        $fields = [
            'cate_name' => 'Name',
            'description' => "Description",
        ];
        unset($data["_token"]);
        $validator = Validator::make($data, $rules, [], $fields);
        $validator->validate();
    }
    function edit($id) {
        $cate = $this->cateRepo->find($id);
        if($cate == null) {
            return redirect()->back()->with('error-msg', 'Category not found!');
        }
        return view('Admin.category.edit')->with('data', $cate);
    }
    function delete($id) {
        $result = $this->cateRepo->delete($id);
        $redirect = redirect()->back();
        if($result) {
            return $redirect->with('success-msg', 'Category deleted!');
        }
        return $redirect->with('error-msg', self::ERROR_MSG);
    }
}
