<?php
namespace StartupsCampfire\Models\ModelTraits;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Event;

/**
 * This is the base model trait.
 *
 */
trait BaseModelTrait
{
    /**
     * 创建模型操作
     *
     * @param array $input
     * @return mixed
     * @throws \Exception
     */
    public static function create(array $input = [])
    {
        DB::beginTransaction();

        try {
            Event::fire(static::$name . '.creating');
            static::beforeCreate($input);
            $return = parent::create($input);
            static::afterCreate($input, $return);
            Event::fire(static::$name . '.created');

            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }

        return $return;
    }

    /**
     * 创建模型前操作
     *
     * @param array $input
     *
     * @return void
     */
    public static function beforeCreate(array $input)
    {
        // 供子类扩展
    }

    /**
     * 创建模型后操作
     *
     * @param array $input
     * @param Model $return
     */
    public static function afterCreate(array $input, Model $return)
    {
        // 供子类扩展
    }

    /**
     * 更新模型
     *
     * @param array $input
     * @return mixed
     * @throws \Exception
     */
    public function update(array $input = [])
    {
        DB::beginTransaction();

        try {
            Event::fire(static::$name . '.updating', $this);
            $this->beforeUpdate($input);
            $return = parent::update($input);
            $this->afterUpdate($input, $return);
            Event::fire(static::$name . '.updated', $this);

            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }

        return $return;
    }

    /**
     * 更新模型前操作
     *
     * @param array $input
     *
     * @return void
     */
    public function beforeUpdate(array $input)
    {
        // 供子类扩展
    }

    /**
     * 更新模型后操作
     *
     * @param array $input
     * @param bool|int $return
     *
     * @return void
     */
    public function afterUpdate(array $input, $return)
    {
        // 供子类扩展
    }

    /**
     * 删除模型
     *
     * @throws \Exception
     *
     * @return bool
     */
    public function delete()
    {
        DB::beginTransaction();

        try {
            Event::fire(static::$name . '.deleting', $this);
            $this->beforeDelete();
            $return = parent::delete();
            $this->afterDelete($return);
            Event::fire(static::$name . '.deleted', $this);

            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }

        return $return;
    }

    /**
     * 删除模型前操作
     *
     * @return void
     */
    public function beforeDelete()
    {
        // 供子类扩展
    }

    /**
     * 删除模型后操作
     *
     * @param bool $return
     *
     * @return void
     */
    public function afterDelete($return)
    {
        // 供子类扩展
    }
}