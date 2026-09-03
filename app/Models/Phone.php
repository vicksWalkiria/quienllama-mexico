<?php

namespace App\Models;

use App\Services\MexicoPhoneHelper;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Phone extends Model
{
    use HasFactory;

    protected $fillable = [
        'number',
        'area_code',
        'location',
        'spam_score',
        'views',
    ];

    protected function casts(): array
    {
        return [
            'spam_score' => 'integer',
            'views' => 'integer',
        ];
    }

    public function comments(): HasMany
    {
        return $this->hasMany(Comment::class)->latest();
    }

    public function formatted(): string
    {
        return MexicoPhoneHelper::format($this->number);
    }

    public function details(): array
    {
        return MexicoPhoneHelper::getDetails($this->number);
    }

    public function dialingInfo(): array
    {
        return MexicoPhoneHelper::getDialingInfo($this->number);
    }

    public function getRiskLevel(): array
    {
        $score = $this->spam_score;
        $commentsCount = $this->comments()->count();

        if ($score >= 70 || $commentsCount >= 5) {
            return [
                'level' => 'Peligroso',
                'color' => '#ef4444',
                'bg' => '#fee2e2',
                'text_color' => '#991b1b',
                'badge' => 'Alto Riesgo de Spam / Estafa',
                'icon' => '🚨',
            ];
        } elseif ($score >= 30 || $commentsCount >= 1) {
            return [
                'level' => 'Sospechoso',
                'color' => '#f59e0b',
                'bg' => '#fef3c7',
                'text_color' => '#92400e',
                'badge' => 'Llamada Sospechosa / Telemarketing',
                'icon' => '⚠️',
            ];
        } else {
            return [
                'level' => 'Neutral',
                'color' => '#3b82f6',
                'bg' => '#dbeafe',
                'text_color' => '#1e40af',
                'badge' => 'Número Desconocido / Sin Denuncias Graves',
                'icon' => 'ℹ️',
            ];
        }
    }
}
