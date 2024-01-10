<?php

namespace Modules\Absence\Entities;

use Modules\Acl\Entities\User;
use Modules\Absence\Entities\Mission;
use Modules\Absence\Entities\Vacation;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Absent extends Model
{
    protected $guarded = [];
    use HasFactory;

    public function user()
    {
        return $this->belongsTo(User::class, 'users_id');
    }

    public function vacation()
    {
        return $this->belongsTo(Vacation::class, 'vacations_id');
    }

    public function mission()
    {
        return $this->belongsTo(Mission::class, 'missions_id');
    }
}
