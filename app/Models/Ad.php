<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo; // Importe isso

class Ad extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'category_id',
        'title',
        'slug',
        'description',
        'price',
        'location',
        'image_path',
    ];

    /**
     * Define a relação: Um Anúncio (Ad) pertence a um Usuário (User)
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Define a relação: Um Anúncio (Ad) pertence a uma Categoria (Category)
     */
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }
}