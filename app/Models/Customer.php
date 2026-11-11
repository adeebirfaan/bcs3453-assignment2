<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    /** @use HasFactory<\Database\Factories\CustomerFactory> */
    use HasFactory;

    /**
     * Columns that may be filled in one go (used by the factory and seeder).
     */
    protected $fillable = [
        'name',
        'email',
        'address',
        'phoneNumber',
        'gender',
        'birthday',
    ];

    /**
     * Cast birthday to a Carbon date so views can format it and read the age.
     */
    protected function casts(): array
    {
        return [
            'birthday' => 'date',
        ];
    }

    /**
     * Scope: only customers of the given gender.
     * Usage: Customer::gender('Male')->get()
     */
    public function scopeGender(Builder $query, string $gender): Builder
    {
        return $query->where('gender', $gender);
    }

    /**
     * Scope: only customers born after the given year (year > $year).
     * Usage: Customer::bornAfter(2000)->get()
     */
    public function scopeBornAfter(Builder $query, int $year): Builder
    {
        return $query->whereYear('birthday', '>', $year);
    }
}
