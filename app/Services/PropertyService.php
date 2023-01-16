<?php

namespace App\Services;

use App\Models\PropertyModel;
use App\Repositories\PropertyRepository as PropertyRepository;

class PropertyService
{
    protected PropertyRepository $propertyRepository;

    const LIST_FETCH_LIMIT = 6;

    public function __construct(PropertyRepository $propertyRepository)
    {
        $this->propertyRepository = $propertyRepository;
    }

    public function getPropertyList(array $request)
    {
        $result = $this->propertyRepository->get(
            self::LIST_FETCH_LIMIT,
            $this->getNextOffset((int) $request['page']),
            $this->getPropertyFilterConditions($request) ?? [],
            $request["sortCondition"]
        );

        return $result;
    }

    private function getNextOffset(int  $currentPage): int
    {
        return ceil($currentPage * self::LIST_FETCH_LIMIT);
    }

    // Can move to a dedicated filter class if more filters comes in future
    private function getPropertyFilterConditions(array $request): array
    {
        return  [
            PropertyModel::FILTER_MIN_PRICE => $request[PropertyModel::FILTER_MIN_PRICE],
            PropertyModel::FILTER_MAX_PRICE => $request[PropertyModel::FILTER_MAX_PRICE],
            PropertyModel::FILTER_MIN_AREA => $request[PropertyModel::FILTER_MIN_AREA],
            PropertyModel::FILTER_MAX_AREA => $request[PropertyModel::FILTER_MAX_AREA]
        ];
    }
}
