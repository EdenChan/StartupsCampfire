<?php
namespace StartupsCampfire\Repositories;

use Illuminate\Support\Facades\Cache;

class NavigationRepository extends AbstractNodeRepository
{
    public function model()
    {
        return \StartupsCampfire\Models\Navigation::class;
    }

    public function getPaginatedNavigations($page_size)
    {
        $model = $this->model;

        return $model::orderBy('parent_id', 'asc')
            ->orderBy('created_at', 'asc')
            ->paginate($page_size);
    }

    public function createNavigation($input)
    {
        $model = $this->model;

        if (!empty($input['parent_id'])) {
            $parent_category = $model::findOrFail($input['parent_id']);
            $parent_category->children()->create($input);
        } else {
            $model::create($input);
        }

        Cache::forget('navigation_tree');
    }

    public function updateNavigation($navigation_id, $input)
    {
        $navigation = $this->model->find($navigation_id);

        $navigation->update($input);

        Cache::forget('navigation_tree');
    }

    public function deleteNavigation($navigation_id)
    {
        $model = $this->model;

        $navigation = $model::findOrFail($navigation_id);

        $navigation->delete();

        Cache::forget('navigation_tree');
    }
}