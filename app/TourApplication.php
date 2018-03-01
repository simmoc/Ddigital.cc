<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TourApplication extends Model
{
    protected $table = 'tourapplications';
         /**
     * Create a slug.
     *
     * @param  string $title
     * @return string
     */
    public function makeSlug($title)
    {
        $slug = str_slug($title);

        $count = TourApplication::whereRaw("slug LIKE '^{$slug}(-[0-9]+)?$'")->count();
        
        return $count ? "{$slug}-{$count}" : $slug;
    }
}
