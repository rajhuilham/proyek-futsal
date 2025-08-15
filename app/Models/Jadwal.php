<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jadwal extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'lapangan_id',
        'start_datetime',
        'end_datetime',
        'price',
        'status',
    ];

    // Relasi ke tabel 'users'
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relasi ke tabel 'lapangans'
    public function lapangan()
    {
        return $this->belongsTo(Lapangan::class);
    }
}