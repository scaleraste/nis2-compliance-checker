<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Control extends Model
{
    use HasFactory;

    protected $fillable = [
        'nis2_ref',
        'framework',
        'code',
        'priority',
        'category',
        'sub_category',
        'description',
        'function',
        'asset_type',
    ];

    public function implementations()
    {
        return $this->hasMany(Implementation::class, 'code_ref', 'code_ref');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function organizations()
    {
        return $this->belongsToMany(Organization::class, 'control_organization');
    }

    public function results()
    {
        return $this->hasMany(Result::class);
    }

}
