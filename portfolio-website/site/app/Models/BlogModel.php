<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BlogModel extends Model
{
  public $table='blogs';
        public $primaryKey='id';
        public $incrementing=true;
        public $keyType='int';
        public  $timestamps=true;
}
