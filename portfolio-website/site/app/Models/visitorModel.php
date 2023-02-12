<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class visitorModel extends Model
{
    use HasFactory;
    public $table ='visitor';
    public $primarykey='id';
    public $incrementing =true;
    public $keyType ='integer';
    public $timeStamps =false;


}
