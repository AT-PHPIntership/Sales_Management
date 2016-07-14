<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    public $image;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'roles', 'birthday', 'gender', 'address', 'phone_number', 'avatar'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public $timestamps = false;

    /**
     * User has many orders
     *
     * @return Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function orders()
    {
        return $this->hasMany('App\Models\Order');
    }

    /**
     * User has many bills
     *
     * @return Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function bills()
    {
        return $this->hasMany('App\Models\Bill');
    }

    /**
     * Encode the password
     *
     * @param string $password password input
     *
     * @return void
     */
    public function setPasswordAttribute($password)
    {
        $this->attributes['password'] = bcrypt($password);
    }

    /**
     * User has a role
     *
     * @return Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function role()
    {
        return $this->hasOne('App\Models\Role', 'id', 'role_id');
    }

    /**
     * User has roles
     *
     * @param Array $roles all roles we need check
     *
     * @return boolean has Role
     */
    public function hasRole($roles)
    {
        $this->have_role = $this->hasRole;
        // Check if the user is a root account
        if ($this->have_role->name == 'Root') {
            return true;
        }

        if (is_array($roles)) {
            foreach ($roles as $need_role) {
                if ($this->checkIfUserHasRole($need_role)) {
                    return true;
                }
            }
        } else {
            return $this->checkIfUserHasRole($roles);
        }
        return false;
    }

    /**
     * Check if user has role
     *
     * @param String $need_role name attribute of \App\Models\Role
     *
     * @return boolean
     */
    private function checkIfUserHasRole($need_role)
    {
        return (strtolower($need_role) == strtolower($this->have_role->name)) ? true: false;
    }
}
