<?php
namespace StartupsCampfire\Repositories\Eloquent;

use Illuminate\Support\Facades\Queue;
use StartupsCampfire\Jobs\SendNotificationEmail;
use StartupsCampfire\Models\User;
use StartupsCampfire\Repositories\Eloquent\RepoTraits\ApplyFilterTrait;
use StartupsCampfire\Repositories\Eloquent\RepoTraits\GetPaginatedModelsTrait;
use StartupsCampfire\Repositories\UserRepositoryInterface;

class UserRepository extends AbstractRepository implements UserRepositoryInterface
{
    use ApplyFilterTrait;
    use GetPaginatedModelsTrait;

    public function model()
    {
        return \StartupsCampfire\Models\User::class;
    }

    public function sendEmailToUsers($data)
    {
        $user_ids_str = $data['form_user_ids'];
        $user_ids = explode(',', $user_ids_str);
        foreach ($user_ids as $user_id) {
            $user = User::find($user_id);
            Queue::push(new SendNotificationEmail($user, $data));
        }
    }
}