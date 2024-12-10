<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Implementation extends Model
{
    use HasFactory;

    protected $fillable = [
        'code_ref',
        'framework_ref',
        'implementation_text'
    ];

    public function control()
    {
        return $this->belongsTo(Control::class, 'code_ref', 'code_ref');
    }
}
