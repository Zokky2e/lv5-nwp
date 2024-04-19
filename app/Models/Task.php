<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\User;

class Task extends Model
{
    use HasFactory;

    protected $fillable = ['naziv_rada', 'engleski_naziv_rada', 'zadatak_rada', 'tip_studija', 'user_id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'user_task');
    }
}
