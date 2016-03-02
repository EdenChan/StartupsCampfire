<?php
namespace StartupsCampfire\Repositories;

use Illuminate\Support\Facades\Cache;
use StartupsCampfire\Repositories\RepoTraits\ApplyFilterTrait;
use StartupsCampfire\Repositories\RepoTraits\GetPaginatedModelsTrait;

class NoticeRepository extends AbstractRepository
{
    use GetPaginatedModelsTrait;
    use ApplyFilterTrait;

    public function model()
    {
        return \StartupsCampfire\Models\Notice::class;
    }

    public function getOnlineNotices()
    {
        $online_notices = Cache::get('online_notices');

        if (empty($online_notices)) {
            $online_notices = $this->model->orderBy('created_at', 'desc')->get();
            Cache::put('online_notices', $online_notices, 60);
        }

        return $online_notices;
    }

    public function updateNotice($notice_id, $input)
    {
        $event = $this->model->find($notice_id);

        $event->update($input);
    }

    public function createNotice($input)
    {
        $this->model->create($input);

        Cache::forget('online_notices');
    }

    public function deleteNotice($notice_id)
    {
        $model = $this->model;

        $notice = $model::findOrFail($notice_id);

        $notice->delete();

        Cache::forget('online_notices');
    }

}