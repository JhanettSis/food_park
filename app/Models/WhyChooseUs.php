<?php

namespace App\Models;

use App\Models\SectionTitle;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WhyChooseUs extends Model
{
    use HasFactory;

    protected $table = 'why_choose_us';
    protected $fillable = [
        'icon',
        'title',
        'short_description',
        'status'
    ];

    /**By guarding the status column,
     * you ensure that it cannot be set through mass assignment,
     * adding an extra layer of protection.
     * You can still manually
     * assign the status attribute if needed:
     * // 'status' => 'active' // This will be ignored if included in mass assignment
     * example on controller
     * $whyChooseUs->status = 'active';
     * $whyChooseUs->save();
     *
     * Allow all other attributes to be mass-assigned
     *          protected $guarded = ['status'];
    */
    protected $guarded = [];
}
