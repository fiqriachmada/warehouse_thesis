<?php

namespace App\Repositories;

use App\Models\Country;

class CountryRepository
{
    public function getAllCountries()
    {
        return Country::orderBy('name', 'ASC')->get();
    }
}