<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;

class Rates extends Model
{
    use HasFactory;
    use Sortable;

    protected $table = 'rates';

    protected $fillable = ['rate', 'value'];

    public $sortable = ['rate','value'];

}
