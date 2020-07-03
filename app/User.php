<?php

namespace App;

use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Auth\Middleware\Authenticate;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

/**
 * @property int $id
 * @property string $name
 * @property string $email
 * @property string $password
 * @property string $role
 * @property int $AFF_ID
 * @property string $remember_token
 * @property boolean $USER_DisplayStat
 * @property string $created_at
 * @property string $updated_at
 * @property RAffiliateInfo $rAffiliateInfo
 * @property PasswordReset[] $passwordResets
 */
class user extends Authenticatable
{
    /**
     * @var array
     */
    protected $fillable = ['id','name', 'email', 'password', 'role', 'AFF_ID', 'remember_token', 'USER_DisplayStat', 'created_at', 'updated_at','profit','businesspermit_path'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function rAffiliateInfo()
    {
        return $this->belongsTo(r_affiliate_info::class, 'AFF_ID', 'AFF_ID');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function passwordResets()
    {
        return $this->hasMany(PasswordReset::class, 'email', 'email');
    }
}
