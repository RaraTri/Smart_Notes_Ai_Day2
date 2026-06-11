<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Chat extends Model
{
    use HasFactory;

    // Tambahkan baris ini buat ngasih izin isi data:
    protected $fillable = ['user_id', 'prompt', 'response'];
}