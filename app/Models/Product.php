<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Storage;

/**
 * Class Product
 * @package App\Models
 */
class Product extends Model
{
    use HasFactory;

    /**
     * @var string
     */
    protected $table = "products";

    /**
     * @var string[]
     */
    protected $fillable = array(
        'user_id',
        'name',
        'description',
        'image',
    );

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\UrlGenerator|string|null
     */
    public function getProductImageAttribute()
    {
        if (isset($this->attributes['image']) && $this->attributes['image'] !== null && $this->attributes['image'] !== "") {
            if (env('STORAGE_DISKS') === "s3") {
                return Storage::disk(env('STORAGE_DISKS'))
                    ->temporaryUrl(
                        $this->attributes['image'], Carbon::now()->addMinutes(30)
                    );
            } else {
                return url('/storage/' . $this->attributes['image']);
            }
        }
        return null;
    }
}
