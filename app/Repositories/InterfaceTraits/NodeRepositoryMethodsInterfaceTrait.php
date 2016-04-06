<?php
namespace StartupsCampfire\Repositories\InterfaceTraits;

interface NodeRepositoryMethodsInterfaceTrait
{
    public function getNodesTree($cache_key);

    public function getDisplayNodesTree($cache_key, $related_model, $foreign_key, $cache_key_prefix = 'display_');

    public function getChildNodesKeys($model_id, $include_self = true, $key = 'id');

}