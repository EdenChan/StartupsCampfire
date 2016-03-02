<?php

namespace StartupsCampfire\Http\Controllers\Backend;

use Illuminate\Support\Facades\Redirect;
use StartupsCampfire\Http\Requests;
use StartupsCampfire\Helpers\ViewHelper;
use StartupsCampfire\Repositories\CategoryRepository;
use StartupsCampfire\Http\Requests\CreateCategoryRequest;

class AdminCategoryController extends AdminCommonController
{
    protected $categoryRepository;

    public function __construct(CategoryRepository $categoryRepository)
    {
        parent::__construct();

        $this->categoryRepository = $categoryRepository;
    }

    public function index()
    {
        $categories = $this->categoryRepository->getPaginatedCategories(15);

        $categories_count = $this->categoryRepository->all()->count();

        return ViewHelper::backView('categories.index', compact('categories', 'categories_count'));
    }

    public function create()
    {
        return ViewHelper::backView('categories.create');
    }

    public function store(CreateCategoryRequest $request)
    {
        $input = $request->all();

        $this->categoryRepository->createCategory($input);

        return Redirect::route('backend::admin.categories.index');
    }

    public function edit($category_id)
    {
        $category = $this->categoryRepository->find($category_id);

        return ViewHelper::backView('categories.edit', compact('category'));
    }

    public function update($category_id, CreateCategoryRequest $request)
    {
        $this->categoryRepository->update($request->all(), $category_id);

        return Redirect::back();
    }

    public function destroy($category_id)
    {
        $this->categoryRepository->deleteCategory($category_id);

        return Redirect::route('backend::admin.categories.index');
    }
}
