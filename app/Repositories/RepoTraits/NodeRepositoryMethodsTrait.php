<?php
namespace StartupsCampfire\Repositories\RepoTraits;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

Trait NodeRepositoryMethodsTrait
{
    /**
     * 取全体节点树(返回Collection实例)
     *
     * @param $cache_key
     * @return mixed
     */
    public function getNodesTree($cache_key)
    {
        $records_tree = Cache::get($cache_key);

        if (empty($records_tree)) {
            $model = $this->model;
            $all_records = $model::get();
            $records_tree = $all_records->toTree();
            Cache::put($cache_key, $records_tree, 60);
        }

        return $records_tree;
    }

    /**
     * 取用于前台展示的全体节点树（返回Collection实例，默认前缀为display_）
     *
     * @param $cache_key
     * @param Model $related_model
     * @param $foreign_key
     * @return
     */
    public function getDisplayNodesTree($cache_key, Model $related_model, $foreign_key, $cache_key_prefix = 'display_')
    {
        $display_cache_key = $cache_key_prefix . $cache_key;
        $display_nodes_tree = Cache::get($display_cache_key);

        if (empty($display_nodes_tree)) {
            $nodes_tree = $this->getNodesTree($cache_key);
            $checked_tree = $this->checkNodesRelatedContent($nodes_tree, $related_model, $foreign_key);
            $display_nodes_tree = $this->removeEmptyNodes($checked_tree);
            Cache::put($display_cache_key, $display_nodes_tree, 60);
        }

        return $display_nodes_tree;
    }

    /**
     * 检查关联模型中是否有关于节点的内容，如果没有，设置标记字段'no_content'为1
     *
     * @param $nodes_tree
     * @param $related_model
     * @param $foreign_key
     * @return mixed
     */
    private function checkNodesRelatedContent($nodes_tree, $related_model, $foreign_key)
    {
        $nodes_tree->each(function ($item, $key) use ($related_model, $foreign_key) {
            // 默认主键为id
            $childNodesKeys = $this->getChildNodesKeys($item->id);
            // 取所有子节点（包含自身）的内容总数
            $related_content_count = $related_model::whereIn($foreign_key, $childNodesKeys)->count();
            if ($related_content_count == 0) {
                $item->no_content = 1;
            }
            $item->content_count = $related_content_count;
            if (!empty($item->children)) {
                $item->children = $this->checkNodesRelatedContent($item->children, $related_model, $foreign_key);
            }
        });

        return $nodes_tree;
    }

    /**
     * 取子节点的主键集合 默认包含自身
     *
     * @param $model_id
     * @param bool $include_self
     * @param string $key 默认主键为id
     * @return array
     */
    public function getChildNodesKeys($model_id, $include_self = true, $key = 'id')
    {
        $model = $this->model;

        $parent_node = $model::find($model_id);
        $child_nodes_keys = $parent_node->descendants()->lists($key);
        if ($include_self) {
            $child_nodes_keys[] = $parent_node->getKey();
        }

        return $child_nodes_keys;
    }

    /**
     * 剔除在关联模型中没有内容的低级树节点
     *
     * @param $nodes_tree
     * @return mixed
     */
    private function removeEmptyNodes(&$nodes_tree)
    {
        $nodes_tree->each(function ($item, $key) use ($nodes_tree) {
            $is_empty = $item->children->isEmpty();
            if (!$is_empty) {
                $this->removeEmptyNodes($item->children);
            } else {
                if (isset($item->no_content) && $item->no_content == 1) {
                    $nodes_tree->forget($key);
                }
            }
        });

        return $nodes_tree;
    }
}