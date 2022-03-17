<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Hospital extends Model
{
    use HasFactory, SoftDeletes;

    // this is a recommended way to declare event handlers
    public static function boot() {
        parent::boot();

        static::deleting(function($hospital) { // before delete() method call this
             $hospital->Patients()->delete();
             // do the rest of the cleanup...
        });
    }

    protected $fillable = [
        'name',
        'address',
        'email',
        'phone',
    ];

    /**
     * Get all of the Patients for the Hospital
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function Patients(): HasMany
    {
        return $this->hasMany(Patient::class);
    }
}
