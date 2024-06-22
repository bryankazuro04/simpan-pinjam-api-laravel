<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Anggota extends Model
{
    // use HasFactory;

    protected $table = 'anggota';
    protected $keyType = 'int';
    protected $primaryKey = 'id';
    public $incrementing = true;
    public $timestamps = true;

    protected $fillable = [
        "nomor_induk",
        "nama",
        "alamat",
        "tanggal_lahir",
        "no_hp",
        "status",
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
    public function tabungan() : HasMany
    {
        return $this->hasMany(TabunganAnggota::class, 'anggota_id', 'id');
    }
}
