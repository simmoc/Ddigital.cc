<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Zizaco\Entrust\Traits\EntrustUserTrait;
use Cmgmyr\Messenger\Traits\Messagable;

class User extends Authenticatable
{
    use Notifiable;
    use EntrustUserTrait;
    use Messagable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

       /**
     * Create a slug.
     *
     * @param  string $title
     * @return string
     */
    // public function makeSlug($title)
    // {
    //     $slug = str_slug($title);

    //     $count = User::whereRaw("slug LIKE '^{$slug}(-[0-9]+)?$'")->count();
        
    //     return $count ? "{$slug}-{$count}" : $slug;
    // }

   public function getLatestUsers($limit = 5)
    {
        return User::orderBy('id','desc')
                     ->limit($limit)
                     ->get();
    }



}





