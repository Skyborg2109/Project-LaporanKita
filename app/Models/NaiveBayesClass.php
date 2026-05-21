<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NaiveBayesClass extends Model
{
    protected $table = 'naive_bayes_classes';

    protected $fillable = ['kategori', 'jumlah_dokumen', 'total_kata'];
}
