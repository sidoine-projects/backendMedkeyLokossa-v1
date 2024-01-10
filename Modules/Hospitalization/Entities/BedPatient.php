<?php

namespace Modules\Hospitalization\Entities;

use Modules\Acl\Entities\User;
use Modules\Patient\Entities\Patiente;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class BedPatient extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'comment',
        'start_occupation_date',
        'end_occupation_date',
        'bed_id',
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
     * Bed
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function bed()
    {
        return $this->belongsTo(Bed::class);
    }

    /** 
     * Patient
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function patient()
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
}
