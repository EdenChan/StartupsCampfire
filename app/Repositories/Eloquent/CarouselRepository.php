<?php
namespace StartupsCampfire\Repositories\Eloquent;


use Illuminate\Support\Facades\Config;
use StartupsCampfire\Helpers\FileHelper;
use StartupsCampfire\Repositories\CarouselRepositoryInterface;

class CarouselRepository extends AbstractRepository implements CarouselRepositoryInterface
{
    public function model()
    {
        return \StartupsCampfire\Models\Carousel::class;
    }

    public function getCarouselsList()
    {
        return $this->model
            ->orderBy('order', 'asc')
            ->orderBy('created_at', 'desc')
            ->get();
    }

    public function getPaginatedCarousels($page_size)
    {
        $model = $this->model;

        return $model::where('type', 'index')
            ->orderBy('created_at', 'desc')
            ->paginate($page_size);
    }

    public function createCarousel($input)
    {
        $model = $this->model;

        $cover_path = public_path(Config::get('filepath.carousel_path'));
        $files_info = ['image' => $cover_path];
        $input = FileHelper::uploadFiles($files_info, $input);

        $model::create($input);
    }

    public function updateCarousel($carousel_id, $input)
    {
        $carousel = $this->model->find($carousel_id);

        //更新幻灯片图片
        $carousel_path = public_path(Config::get('filepath.carousel_path'));
        $new_files_info = ['image' => $carousel_path];
        $old_files_info = [$carousel->image => $carousel_path];
        $input = FileHelper::replaceFiles($new_files_info, $old_files_info, $input);

        $carousel->update($input);
    }

    public function deleteCarousel($carousel_id)
    {
        $model = $this->model;

        $carousel = $model::findOrFail($carousel_id);

        $carousel->delete();
    }
}