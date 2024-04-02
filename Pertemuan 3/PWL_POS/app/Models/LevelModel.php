<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illumimate\Database\Eloquent\Relations\BelongsTo;

class LevelModel extends Model {
    protected $table = 'm_level';
    protected $primayKey = 'level_id';

    protected $fillable = ['level_kode', 'level_nama'];
    
}