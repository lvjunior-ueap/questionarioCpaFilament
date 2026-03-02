<?php

namespace App\Models;

use App\Enums\QuestionType;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    protected $fillable = [
        'dimension_id',
        'text',
        'type',
        'required',
        'order',
    ];

    protected $casts = [
        'required' => 'boolean',
        'type' => QuestionType::class,
    ];

    public function dimension()
    {
        return $this->belongsTo(Dimension::class);
    }

    public function options()
    {
        return $this->hasMany(Option::class)
            ->orderBy('order');
    }

    public function answers()
    {
        return $this->hasMany(Answer::class);
    }
}