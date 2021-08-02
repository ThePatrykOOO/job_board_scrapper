<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobOffer extends Model
{
    use HasFactory;

    protected $fillable = [
      'title',
      'reference_number',
      'short_description',
      'long_description',
      'link_to_application',
    ];
}
