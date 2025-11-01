<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Unit extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'title',
        'type',
        'land_area',
        'price',
        'image',
        'images',
        'description',
        'bedrooms',
        'bathrooms',
        'floor_area',
        'parking',
        'built_year'
    ];
    
    protected $casts = [
        'images' => 'array',
    ];
    
    /**
     * Get all images (main image + additional images)
     */
    public function getAllImages()
    {
        $allImages = [];
        
        // Add main image first if exists
        if ($this->image) {
            $allImages[] = $this->image;
        }
        
        // Add additional images
        if ($this->images && is_array($this->images)) {
            $allImages = array_merge($allImages, $this->images);
        }
        
        return $allImages;
    }
}
