<?php

namespace App\Models;

use Database\Factories\FAQFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Faq extends Model
{
    use HasFactory;

    protected $fillable = [
        'group_id',
        'question',
        'answer',
    ];

    protected static function newFactory()
    {
        return FAQFactory::new();
    }

    public function group()
    {
        return $this->belongsTo(Group::class);
    }
}