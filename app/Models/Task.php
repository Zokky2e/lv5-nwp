<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use User;

class Task extends Model
{
    use HasFactory;

    protected $fillable = ['naziv_rada', 'engleski_naziv_rada', 'zadatak_rada', 'tip_studija', 'user_id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
