<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

use App\Permissions\HasPermissionsTrait;

use Role;

class User extends Authenticatable
{
    use Notifiable, HasPermissionsTrait;
    //use roles;

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

    public function roles()
    {
      return $this->belongsToMany(Role::class);
    }


    public function assignRole($role) { 
        return $this->roles()->attach($role); 
    }
    

    public function permissions()
    {
      return $this->belongsToMany(Permissions::class);
    }

    public function post(){
        return $this->hasMany(Post::class);
    }

    public function files()
    {
       return $this->hasMany(File::class);
    }

    public function publish(Post $post)
    {
        $this->posts()->save($post);      
    }

    public function authorizeRoles($roles)
    { 
      if (is_array($roles)) { 
         return $this->hasAnyRole($roles) || 
                 abort(401, 'This action is unauthorized.');
      }
      return $this->hasRole($roles) || 
             abort(401, 'This action is unauthorized.');
    }

    /**
    * Check multiple roles
    * @param array $roles
    */

    public function hasAnyRole($roles)
    {
      return null !== $this->roles()->whereIn('name', $roles)->firstOrFail();
    }

    /**
    * Check one role
    * @param string $role
    */
    public function hasRole($role)
    {
      return null !== $this->roles()->where('name', $role)->firstOrFail();
    }

}
