<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\BaseController;
use App\Repositories\Category\CategoryRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CategoryController extends BaseController
{
    protected $cateRepo;

    public function __construct(CategoryRepositoryInterface $cateRepo)
    {
        $this->cateRepo = $cateRepo;
    }

    /**
     * Admin category index page
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Foundation\Application
     */
    function index(Request $request)
    {
        $cateName = isset($request->cate_name) ? $request->cate_name : false;
        if ($cateName) {
            $result = $this->cateRepo->searchCategory($cateName)->paginate();
        } else {
            $result = $this->cateRepo->getAllWith(['id', 'cate_name', 'description'])->paginate();
        }
        return view('Admin.category.index')->with('data', $result);
    }

    /**
     * Create category page
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Foundation\Application
     */
    function create()
    {
        return view('Admin.category.create');
    }

    /**
     * Submit create/edit category
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    function save(Request $request, $id = null)
    {
        $data = $request->all();
        $this->customValidate($data);
        try {
            $this->cateRepo->updateOrCreate($data, $id);
            if ($id == null) {
                $msg = "Category created!";
            } else {
                $msg = "Category updated!";
            }
            return redirect()->route('admin.category.index')->with('success-msg', $msg);
        } catch (\ErrorException $exception) {
            return redirect()->route('admin.category.index')->with('error-msg', self::ERROR_MSG);
        }
    }

    /**
     * Validation data category
     * @param $data
     * @return void
     */
    private function customValidate($data)
    {
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

    /**
     * Find category by $id to edit
     * @param $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Foundation\Application|\Illuminate\Http\RedirectResponse
     */
    function edit($id)
    {
        $cate = $this->cateRepo->find($id);
        if ($cate == null) {
            return redirect()->back()->with('error-msg', 'Category not found!');
        }
        return view('Admin.category.edit')->with('data', $cate);
    }

    /**
     * Delete category by $id
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    function delete($id)
    {
        $result = $this->cateRepo->delete($id);
        $redirect = redirect()->back();
        if ($result) {
            return $redirect->with('success-msg', 'Category deleted!');
        }
        return $redirect->with('error-msg', self::ERROR_MSG);
    }
}
