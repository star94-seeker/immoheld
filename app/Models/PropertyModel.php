<?php

namespace App\Models;

use CodeIgniter\Model;

class PropertyModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'properties';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['title','price'];

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules      = [];
    protected $validationMessages   = [];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert   = [];
    protected $afterInsert    = [];
    protected $beforeUpdate   = [];
    protected $afterUpdate    = [];
    protected $beforeFind     = [];
    protected $afterFind      = [];
    protected $beforeDelete   = [];
    protected $afterDelete    = [];

    const FILTER_MIN_PRICE = 'minPrice';
    const FILTER_MAX_PRICE = 'maxPrice';
    const FILTER_MIN_AREA = 'minArea';
    const FILTER_MAX_AREA = 'maxArea';

    const SORT_BY_HIGH_PRICE = 'hprice';
    const SORT_BY_LOW_PRICE = 'lprice';
    const SORT_BY_LARGE_AREA = 'larea';
    const SORT_BY_SMALL_AREA = 'sarea';
}
