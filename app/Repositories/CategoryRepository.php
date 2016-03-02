<?php
namespace StartupsCampfire\Repositories;

use Illuminate\Support\Facades\Cache;

class CategoryRepository extends AbstractNodeRepository
{
    public function model()
    {
        return \StartupsCampfire\Models\Category::class;
    }

    public function getPaginatedCategories($page_size)
    {
        $model = $this->model;

        return $model::orderBy('parent_id', 'asc')
            ->orderBy('created_at', 'asc')
            ->paginate($page_size);
    }

    public function createCategory($input)
    {
        $model = $this->model;
        $last_record = $model::orderBy('id', 'desc')->first();

        // 默认使用当前分类id作为分类的url参数名
        if (empty($input['url_tag']) || is_null($input['url_tag'])) {
            if (is_null($last_record)) {
                $input['url_tag'] = 1;
            }
            $input['url_tag'] = intval($last_record['id']) + 1;
        }
        if (!empty($input['parent_id'])) {
            $parent_category = $model::findOrFail($input['parent_id']);
            $parent_category->children()->create($input);
        } else {
            $model::create($input);
        }

        Cache::forget('category_tree');
        Cache::forget('display_category_tree');
    }

    public function deleteCategory($category_id)
    {
        $model = $this->model;

        $category = $model::findOrFail($category_id);

        $category->delete();

        Cache::forget('category_tree');
        Cache::forget('display_category_tree');
    }
}