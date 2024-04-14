<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illumimate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class LevelModel extends Model {
    
    use HasFactory;

    protected $table = 'm_level';
    protected $primaryKey = 'level_id';
    protected $fillable = ['level_kode', 'level_nama'];
    
}