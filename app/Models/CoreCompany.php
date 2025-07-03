<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CoreCompany extends Model
{
  protected $table = 'core_company';

  protected $fillable = [
    'company_name',
    'company_code',
    'registration_number',
    'tin_number',
    'gst_number',
    'legal_entity_type',
    'logo',
    'website',
    'email',
    'groups_of_company'
  ];
}
