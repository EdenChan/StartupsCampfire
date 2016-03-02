<?php
namespace StartupsCampfire\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\File;

class Carousel extends AbstractModel
{
    protected $table = 'carousels';

    public static $name = 'carousel';

    use SoftDeletes;

    protected $dates = ['deleted_at'];

    protected $fillable = ['order', 'url', 'image', 'type'];

    protected $appends = ['image_full_path'];

    public function getImageFullPathAttribute()
    {
        $image = $this->attributes['image'];
        $image_path = Config::get('filepath.carousel_path');
        $image_file_path = public_path($image_path . $image);
        $image_full_path = asset($image_path . $image);
        if (!File::exists($image_file_path)) {
            $image_full_path = 'http://placehold.it/1900x1080&text=Slide One';
        }

        return $image_full_path;
    }
}
