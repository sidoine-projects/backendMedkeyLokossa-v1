<?php

namespace Modules\Acl\Entities;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;
use Venturecraft\Revisionable\RevisionableTrait;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;


class User extends Authenticatable implements MustVerifyEmail, HasMedia {

    use HasFactory,
        Notifiable,
        HasApiTokens,
        HasRoles,
        RevisionableTrait,
        SoftDeletes,
        InteractsWithMedia;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'tel_mobile_verified_at',
    ];
    protected $guarded = [];
    // protected $guard_name = 'api';

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
       'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'tel_mobile_verified_at' => 'datetime',
    ];

    /*
      |--------------------------------------------------------------------------
      | FUNCTIONS
      |--------------------------------------------------------------------------
     */

    /**
     * Tester si user courant a le role admin
     *
     * @return Boolean
     */
    // public function isMagasinier() {
    //     return $this->hasRole([Role::magasinier()->name], guard_web());
    // }

    /**
     * Tester si user courant a le role admin
     *
     * @return Boolean
     */
    // public function isAdmin() {
    //     return $this->hasRole([Role::admin()->name], guard_web());
    // }

    /**
     * Redéfinition de la fonction d'envoi de courriel de réinitialisation de mot de passe
     * @param mixed
     */
    public function sendPasswordResetNotification($token)
    {
        $this->notify(new \Modules\Acl\Notifications\ResetPasswordCustom($token));
    }
    
    /**
     * Vérifie la permission de cet utilisateur
     * @param $name
     * @return boolean
     */
    public function isPermission($name)
    {
        return $this->hasPermissionTo($name, guard_web());
    }

    /**
     * Obtenir les médias associés
     */
    public function obtenirMediaUrlsFormates($media_collection_name) {
        $mediaItems = $this->getMedia($media_collection_name);
        $urls = [];
        foreach ($mediaItems as $mediaItem) {
            $urls[$mediaItem->file_name] = [
                'uuid' => $mediaItem->uuid,
                'mime_type' => $mediaItem->mime_type,
                'size' => $mediaItem->size,
                'human_readable_size' => $mediaItem->human_readable_size,
                'public_url' => $mediaItem->getUrl(),
                'public_full_url' => $mediaItem->getUrl(),//$this->assetTenant($mediaItem),
                //'full_path_on_disk' => $mediaItem->getPath(),
            ];
        }
        return $urls;
    }
    
    
    /*
      |--------------------------------------------------------------------------
      | RELATIONS
      |--------------------------------------------------------------------------
     */

    /*
      |--------------------------------------------------------------------------
      | SCOPES
      |--------------------------------------------------------------------------
     */


    /*
      |--------------------------------------------------------------------------
      | ACCESORS
      |--------------------------------------------------------------------------
     */

    /*
      |--------------------------------------------------------------------------
      | MUTATORS
      |--------------------------------------------------------------------------
     */
    /**
     * Obtenir le nom complet de l'utilisateur
     *  
     * @return string
     */
    public function getFullNameAttribute() {
        return ucfirst($this->name) . ' ' . ucfirst($this->prenom);
    }

}
