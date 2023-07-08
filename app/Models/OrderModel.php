<?php

namespace App\Models;

use CodeIgniter\Model;

class OrderModel extends Model
{
    protected $table = 'orders';
    protected $primaryKey = 'id';
    protected $allowedFields = ['food_id', 'name', 'quantity', 'price', 'status'];
    protected $returnType = 'array';
}
