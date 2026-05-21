<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NaiveBayesWord extends Model
{
    protected $table = 'naive_bayes_words';

    protected $fillable = ['kategori', 'kata', 'frekuensi'];
}
