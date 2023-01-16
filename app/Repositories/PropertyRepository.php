<?php

namespace App\Repositories;

use App\Models\PropertyModel as PropertyModel;

class PropertyRepository
{
    protected $propertyModel;

    public function __construct(PropertyModel $propertyModel)
    {
        $this->propertyModel = $propertyModel;
    }

    public function get(
        int $limit,
        int $offset,
        array $filterConditions = [],
        string $sortCondition = null
    ) {
        $queryBuilder = $this->propertyModel
            ->select('properties.*, property_images.image_name as image')
            ->join('property_images', '(property_images.property_id = properties.id) and (property_images.is_main =1)', 'left')
            ->where('properties.status', '1');


        $this->setFilterConditions($filterConditions, $queryBuilder);
        $this->setSortCondition($sortCondition, $queryBuilder);


        $properties = $queryBuilder->findAll($limit, $offset);
        return $properties;
    }

    private function setFilterConditions(array $filterConditions, $queryBuilder)
    {
        foreach ($filterConditions as $filter => $filterCondition) {
            if (!empty($filterCondition)) {
                switch ($filter) {
                    case PropertyModel::FILTER_MIN_PRICE:
                        $queryBuilder->where('properties.price >=', $filterConditions[PropertyModel::FILTER_MIN_PRICE]);
                        break;

                    case PropertyModel::FILTER_MAX_PRICE:
                        $queryBuilder->where('properties.price <=', $filterConditions[PropertyModel::FILTER_MAX_PRICE]);
                        break;

                    case PropertyModel::FILTER_MIN_AREA:

                        $queryBuilder->where('properties.size >=', $filterConditions[PropertyModel::FILTER_MIN_AREA]);
                        break;

                    case PropertyModel::FILTER_MAX_AREA:
                        $queryBuilder->where('properties.size <=', $filterConditions[PropertyModel::FILTER_MAX_AREA]);
                        break;
                }
            }
        }
    }

    private function setSortCondition($sortCondition, $queryBuilder)
    {
        switch ($sortCondition) {
            case PropertyModel::SORT_BY_LOW_PRICE:
                $queryBuilder->orderBy('properties.price', 'asc');
                break;

            case PropertyModel::SORT_BY_HIGH_PRICE:
                $queryBuilder->orderBy('properties.price', 'desc');
                break;

            case PropertyModel::SORT_BY_SMALL_AREA:
                $queryBuilder->orderBy('properties.size', 'asc');
                break;

            case PropertyModel::SORT_BY_LARGE_AREA:
                $queryBuilder->orderBy('properties.size', 'desc');
                break;

            default:
                $queryBuilder->orderBy('properties.id', 'desc');
                break;
        }
    }
}
