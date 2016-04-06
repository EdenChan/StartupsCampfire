<?php
namespace StartupsCampfire\Repositories\Eloquent\RepoTraits;

use StartupsCampfire\Models\User;

Trait ApplyFilterTrait
{
    public function applyFilter($filter = '')
    {
        if(!empty($filter)) {
            switch ($filter) {
                case 'nocomment':
                    return $this->model->orderBy('comment_count', 'asc');
                    break;
                case 'comment':
                    return $this->model->orderBy('comment_count', 'desc');
                    break;
                case 'vote':
                    return $this->model->orderBy('vote_count', 'desc');
                    break;
                case 'recent':
                    return $this->model;
                    break;
                default:
                    if($this->model instanceof User) {
                        return $this->model->where(function ($query) use ($filter) {
                            $query->where('name', 'LIKE', '%'.$filter.'%');
                        });
                    } else {
                        return $this->model->where(function ($query) use ($filter) {
                            $query->where('title', 'LIKE', '%'.$filter.'%');
                        });
                    }
                    break;
            }
        } else {
            return $this->model;
        }
    }
}