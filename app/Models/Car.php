<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Car extends Model
{
    use HasFactory;


    protected $fillable = ['name', 'registration_number', 'is_registered'];


    protected $casts = [
        'is_registered' => 'boolean',
    ];


    public function parts()
    {
        return $this->hasMany(Part::class);
    }

    public function setRegistrationNumberAttribute($value): void
    {
        if ($value === null) {
            $this->attributes['registration_number'] = null;
            return;
        }
        $norm = strtoupper(preg_replace('/[\s\-]+/', '', $value));
        $this->attributes['registration_number'] = $norm;
    }
}
