<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Carbon\Carbon;

class User extends Authenticatable
{
    protected $dates = ['birthday'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'role_id', 'birthday', 'gender', 'address', 'phone_number', 'avatar'
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
        if (is_array($roles)) {
            foreach ($roles as $role) {
                if ($this->checkIfUserHasRole($role)) {
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
     * @param String $role name attribute of \App\Models\Role
     *
     * @return boolean
     */
    private function checkIfUserHasRole($role)
    {
        return (strtolower($role) == strtolower($this->role->name)) ? true: false;
    }

    /**
     * Format the date field in access
     *
     * @param string $date date input
     *
     * @return void
     */
    public function setBirthdayAttribute($date)
    {
        $this->attributes['birthday'] = Carbon::createFromFormat(\Config::get('common.DATE_DMY_FORMAT'), $date)->toDateString();
    }

    /**
     * Format the date to d/m/Y
     *
     * @param string $date date
     *
     * @return void
     */
    public function getBirthdayAttribute($date)
    {
        return Carbon::parse($date)->format(\Config::get('common.DATE_DMY_FORMAT'));
    }
}
