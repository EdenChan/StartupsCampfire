<?php
namespace StartupsCampfire\Repositories;

use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Event;
use StartupsCampfire\Events\MentionUsers;
use StartupsCampfire\Helpers\FileHelper;
use StartupsCampfire\Helpers\MentionHelper;
use StartupsCampfire\Repositories\RepoTraits\ApplyFilterTrait;
use StartupsCampfire\Repositories\RepoTraits\GetPaginatedModelsTrait;
use StartupsCampfire\Repositories\RepoTraits\GetPaginatedUserModelsTrait;
use StartupsCampfire\Repositories\RepoTraits\VotableRepositoryTrait;

class EventRepository extends AbstractRepository
{
    use GetPaginatedModelsTrait;
    use GetPaginatedUserModelsTrait;
    use VotableRepositoryTrait;
    use ApplyFilterTrait;

    public function model()
    {
        return \StartupsCampfire\Models\Event::class;
    }

    public function getPaginatedEvents($page_size = 10, $filter = '')
    {
        return $this->applyFilter($filter)
            ->online()
            ->orderBy('created_at', 'desc')
            ->paginate($page_size);
    }

    public function getHotEvents($count_size)
    {
        return $this->model->online()
            ->take($count_size)
            ->get();
    }

    public function updateEvent($event_id, $input)
    {
        $event = $this->model->find($event_id);

        // 更新封面图
        $cover_path = public_path(Config::get('filepath.event_cover_path'));
        $new_files_info = ['cover' => $cover_path];
        $old_files_info = [$event->cover => $cover_path];
        $input = FileHelper::replaceFiles($new_files_info, $old_files_info, $input);

        $event->update($input);
    }

    public function createUserEvent($input)
    {
        $cover_path = public_path(Config::get('filepath.event_cover_path'));
        $files_info = ['cover' => $cover_path];
        $input = FileHelper::uploadFiles($files_info, $input);

        $parsed_result = MentionHelper::parse($input['content'], false);
        $input['body_parsed'] = $parsed_result['body_parsed'];
        $users_mentioned = $parsed_result['users_mentioned'];

        $event = $this->model->create($input);

        if (count($users_mentioned) > 0) {
            Event::fire(new MentionUsers($users_mentioned, $event));
        }
    }

    public function deleteUserEvent($event_id)
    {
        $model = $this->model;

        $event = $model::findOrFail($event_id);

        $event->delete();
    }

}