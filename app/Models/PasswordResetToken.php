<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PasswordResetToken extends Model
{
    use HasFactory, HasUuids;

    protected $table = "password_reset_tokens";

    protected $fillable = [
        'user_id'
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    protected static function booted()
    {
        static::addGlobalScope('non_expired', function (Builder $builder) {
            $builder->where('expires_at', '<', now());
        });

        static::creating(function (PasswordResetToken $resetToken) {
            PasswordResetToken::withoutGlobalScope('non_expired')->where('user_id', $resetToken->user_id)->delete();
            $resetToken->expires_at = now()->addHours(2);
        });

        static::created(function (PasswordResetToken $resetToken) {
            // TODO: Enviar e-mail de redefinição de senha
        });
    }
}
