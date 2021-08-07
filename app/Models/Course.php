<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class Course extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'description', 'picture', 'background'];

    protected $attributes = [
        'title' => 'Заголовок',
        'description' => 'Описание',
        'background' => 'hsl(60, 11%, 94%)',
        'is_active' => true,
    ];

    public function lectures(): HasMany
    {
        return $this->hasMany(Lecture::class);
    }

    public static function getPictureDefaultPath():string
    {
        return  Storage::url("courses/course.webp");
    }

    public function createDir($courseId): void
    {
        Storage::deleteDirectory("courses/{$courseId}");
        Storage::makeDirectory("courses/{$courseId}");
    }

    public function savePicture($picture, $name, $courseId): void
    {
        $path = '/'.storage_path('app/public/courses/').$courseId.'/'.$name.'.webp';
        $image = Image::make($picture);
        $height = $image->height();
        $width = $image->width();

        if ($width > $height) {
            $image->resize(null, 500, function ($constraint) {
                $constraint->aspectRatio();
            });
            $x = (int) ($image->width() / 2) - 250;
            $image->crop(500, 500, $x, 0);
        } else {
            $image->resize(500, null, function ($constraint) {
                $constraint->aspectRatio();
            });
            $y = (int) ($image->height() / 2) - 250;
            $image->crop(500, 500, 0, $y);
        }

        $image->save($path, 75, 'webp');
    }
}
