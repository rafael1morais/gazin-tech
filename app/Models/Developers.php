<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Developers extends Model
{
    protected $table = 'developers';

    protected $fillable = ['id', 'nivel', 'nome', 'sexo', 'datanascimento', 'idade', 'hobby'];
}
