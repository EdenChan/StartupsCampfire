<?php
namespace StartupsCampfire\Repositories\Eloquent;


use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Event;
use StartupsCampfire\Events\MentionUsers;
use StartupsCampfire\Helpers\MentionHelper;
use StartupsCampfire\Repositories\Eloquent\RepoTraits\ApplyFilterTrait;
use StartupsCampfire\Repositories\Eloquent\RepoTraits\GetPaginatedModelsTrait;
use StartupsCampfire\Repositories\Eloquent\RepoTraits\GetPaginatedUserModelsTrait;
use StartupsCampfire\Repositories\Eloquent\RepoTraits\VotableRepositoryTrait;
use StartupsCampfire\Repositories\PostRepositoryInterface;

class PostRepository extends AbstractRepository implements PostRepositoryInterface
{
    use GetPaginatedModelsTrait;
    use GetPaginatedUserModelsTrait;
    use VotableRepositoryTrait;
    use ApplyFilterTrait;

    public function model()
    {
        return \StartupsCampfire\Models\Post::class;
    }

    public function getHotPosts($count_size = 10)
    {
        return $this->model->orderBy('vote_count', 'desc')
            ->orderBy('created_at', 'desc')
            ->take($count_size)
            ->get();
    }

    public function getPaginatedCategoryPosts($category_ids, $page_size = 10, $filter = '')
    {
        return $this->applyFilter($filter)->whereIn('category_id', $category_ids)
            ->orderBy('created_at', 'desc')
            ->paginate($page_size);
    }


    public function getPaginatedFocusPosts($page_size, $filter = '')
    {
        $user_model = Auth::user();
        $followings_ids = $user_model->followings()->lists('follow_id');

        return $this->applyFilter($filter)->whereIn('user_id', $followings_ids)
            ->orderBy('created_at', 'desc')
            ->paginate($page_size);
    }

    public function createUserPost($input)
    {
        $parsed_result = MentionHelper::parse($input['content'], false);
        $input['body_parsed'] = $parsed_result['body_parsed'];
        $users_mentioned = $parsed_result['users_mentioned'];

        $post = $this->model->create($input);

        if (count($users_mentioned) > 0) {
            Event::fire(new MentionUsers($users_mentioned, $post));
        }

        Cache::forget('category_tree');
        Cache::forget('display_category_tree');
    }

    public function deleteUserPost($post_id)
    {
        $model = $this->model;

        $post = $model::findOrFail($post_id);

        $post->delete();

        Cache::forget('category_tree');
        Cache::forget('display_category_tree');
    }

}