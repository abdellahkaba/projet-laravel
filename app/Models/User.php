<?php

namespace App\Models;

use App\Models\Role;
use App\Models\Paiement;
use App\Models\Permission;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'nom','prenom','sexe','telephone','adresse','email','password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function roles(){
        return $this->belongsToMany(Role::class,"user_role","user_id","role_id");
    }

    //verification de role des utilisateurs
    public function hasRole($role){
        return $this->roles()->where("nom",$role)->first() !==null;
    }
    public function hasAnyRole($roles){
        return $this->roles()->whereIn("nom",$roles)->first() !==null;
    }

    public function getAllRoleNamesAttribute(){
        return $this->roles->implode("nom" , "|");
    }

    public function paiement(){
        return $this->hasMany(Paiement::class);
    }
    
    public function permissions(){
        return $this->belongsToMany(Permission::class,"user_permission","user_id","permission_id");
    }
}
