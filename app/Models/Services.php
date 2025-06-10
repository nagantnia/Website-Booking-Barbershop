<?php

namespace App\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

class Services extends Model
{
    use CrudTrait;

    protected $fillable = [
        'service_name',
        'image'
    ];

    public function setImageAttribute($value)
    {
        if ($value == null) {
            Storage::disk('public')->delete($this->image);
            $this->attributes['image'] = null;
            return;
        }

        if (is_string($value) && str_starts_with($value, 'data:image')) {
            $filename = 'services-' . uniqid() . '.jpg';
            $path = 'uploads/services/' . $filename;
            
            $image = Image::make($value)->encode('jpg', 90);
            Storage::disk('public')->put($path, $image->stream());
            
            $this->attributes['image'] = $path;
        } else if (is_file($value)) {
            $filename = 'services-' . uniqid() . '.' . $value->getClientOriginalExtension();
            $path = 'uploads/services/' . $filename;
            
            Storage::disk('public')->put($path, file_get_contents($value));
            
            $this->attributes['image'] = $path;
        }
    }

    // Untuk memastikan URL gambar lengkap saat diakses melalui API
    protected $appends = ['image_url'];

    public function getImageUrlAttribute()
    {
        return $this->image ? Storage::url($this->image) : null;
    }
}