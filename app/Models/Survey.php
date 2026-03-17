<?php

namespace App\Models;

use App\Enums\AudienceType;
use Illuminate\Database\Eloquent\Model;

class Survey extends Model
{
    protected $fillable = [
        'name',
        'audience',
        'year',
        'version',
        'is_active',
        'intro_text',
    ];

    protected $casts = [
        'year' => 'integer',
        'version' => 'integer',
        'is_active' => 'boolean',
        'audience' => AudienceType::class,
    ];

    protected static function booted()
    {
        static::saving(function ($survey) {

            if ($survey->is_active) {

                static::where('audience', $survey->audience)
                    ->where('year', $survey->year)
                    ->where('id', '!=', $survey->id)
                    ->update(['is_active' => false]);
            }
        });
    }

    public function dimensions()
    {
        return $this->hasMany(Dimension::class)
            ->orderBy('order');
    }

    public function questions()
    {
        return $this->hasMany(Question::class)
            ->orderBy('order');
    }

    public function generalQuestions()
    {
        return $this->hasMany(Question::class)
            ->whereNull('dimension_id')
            ->where('text', '!=', 'Sugestões:')
            ->orderBy('order');
    }

    public function finalQuestions()
    {
        return $this->hasMany(Question::class)
            ->whereNull('dimension_id')
            ->where('text', 'Sugestões:')
            ->orderBy('order');
    }

}