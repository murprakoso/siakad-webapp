<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use HasFactory;

    protected $table = 'tb_settings';

    protected $fillable = [
        'school_name',
        'school_address',
        'school_phone',
        'school_email',
        'site_name',
        'site_description',
        'site_logo',
        'site_favicon',
        'contact_email',
        'contact_phone',
        'contact_address'
    ];

    // Accessor for the logo URL
    public function getSiteLogoUrlAttribute()
    {
        return $this->site_logo ? asset('storage/' . $this->site_logo) : null;
    }

    // Accessor for the favicon URL
    public function getSiteFaviconUrlAttribute()
    {
        return $this->site_favicon ? asset('storage/' . $this->site_favicon) : null;
    }
}
