<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lapangan extends Model
{
    use HasFactory;

    public function jadwals()
    {
        // Satu lapangan punya banyak jadwal
        return $this->hasMany(Jadwal::class);
    }
}