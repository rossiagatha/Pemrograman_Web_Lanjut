<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illumimate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsTo as RelationsBelongsTo;

class LevelModel extends Model {
    public function user() : BelongsTo {
        return $this->belongsTo(UserModel::class);
    }
}