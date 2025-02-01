<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PrivacyPolicy extends Model
{
    /** @use HasFactory<\Database\Factories\PrivacyPolicyFactory> */
    use HasFactory;
    
    protected $fillable = ['content'];
}
