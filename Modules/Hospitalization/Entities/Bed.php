<?php

namespace Modules\Hospitalization\Entities;

use Modules\Acl\Entities\User;
use Modules\Patient\Entities\Patiente;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Bed extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'code',
        'name',
        'state',
        'room_id',
        'patient_id',
        'user_id',
        'is_synced',
        'uuid',
    ];

    protected $casts = [
        'is_synced' => 'boolean'
    ];

    protected $dates = [
        'deleted_at'
    ];

    /** 
     * Room
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function room()
    {
        return $this->belongsTo(Room::class);
    }

    /** 
     * Patient
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function currentPatient()
    {
        return $this->belongsTo(Patiente::class);
    }

    /** 
     * User
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Patients
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function allPatients()
    {
        return $this->hasMany(BedPatient::class);
    }
}
