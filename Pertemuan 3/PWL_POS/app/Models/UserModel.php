<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Foundation\Auth\User as Authenticatable;

class UserModel extends Authenticatable
{
    use HasFactory;

    protected $table = 'm_user';        // Mendefinisikan nama tabel yang digunakan oleh model ini
    protected $primaryKey = 'user_id';  // Mendefinisikan primary key dari tabel yang digunakan
    protected $fillable = ['level_id', 'username', 'nama', 'password', 'profil_img', 'status_validasi'];

    //pertemuan 4 praktikum 2.7
    public function level(): BelongsTo {
        return $this->belongsTo(LevelModel::class, 'level_id', 'level_id');
    }
    protected $hidden = [
        'password',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'password' => 'hashed',
    ];
}
