<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Film extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'titulo',
        'diretor', 
        'ano',
        'avaliacao',
        'assistido',
        'observacoes',
        'user_id'
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'assistido' => 'boolean',
        'avaliacao' => 'decimal:1'
    ];

    /**
     * Get the user that owns the film.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Scope a query to only include watched films.
     */
    public function scopeAssistidos($query)
    {
        return $query->where('assistido', true);
    }

    /**
     * Scope a query to only include unwatched films.
     */
    public function scopeNaoAssistidos($query)
    {
        return $query->where('assistido', false);
    }

    /**
     * Get formatted rating with stars.
     */
    public function getAvaliacaoFormatadaAttribute()
    {
        if (!$this->avaliacao) {
            return 'Não avaliado';
        }
        
        $stars = str_repeat('⭐', (int) $this->avaliacao);
        return $stars . ' (' . $this->avaliacao . '/10)';
    }
}
