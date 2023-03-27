<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class PeopleInformation extends Model
{
    use HasFactory;

    protected $table = 'people_information';

    protected $fillable = [
        'name',
        'linkedin',
        'github',
    ];

    public function setNameAttribute($value)
    {
        $name = Str::ascii($value);

        if (!preg_match('/^[a-zA-Z0-9\s]+$/', $name)) {
            throw new \InvalidArgumentException('The name cannot contain special characters.');
        }

        $this->attributes['name'] = $name;
    }
}
