<?php

namespace StartupsCampfire\Http\Controllers\Backend;

use Illuminate\Support\Facades\Redirect;
use StartupsCampfire\Http\Requests;
use StartupsCampfire\Helpers\ViewHelper;
use StartupsCampfire\Http\Requests\CreateCategoryRequest;

class AdminCategoryController extends AdminCommonController
{
    public function index()
    {
        $categories = \CategoryRepository::getPaginatedCategories(15);

        $categories_count = \CategoryRepository::all()->count();

        return ViewHelper::backView('categories.index', compact('categories', 'categories_count'));
    }

    public function create()
    {
        return ViewHelper::backView('categories.create');
    }

    public function store(CreateCategoryRequest $request)
    {
        $input = $request->all();

        \CategoryRepository::createCategory($input);

        return Redirect::route('backend::admin.categories.index');
    }

    public function edit($category_id)
    {
        $category = \CategoryRepository::find($category_id);

        return ViewHelper::backView('categories.edit', compact('category'));
    }

    public function update($category_id, CreateCategoryRequest $request)
    {
        \CategoryRepository::update($request->all(), $category_id);

        return Redirect::back();
    }

    public function destroy($category_id)
    {
        \CategoryRepository::deleteCategory($category_id);

        return Redirect::route('backend::admin.categories.index');
    }
}
