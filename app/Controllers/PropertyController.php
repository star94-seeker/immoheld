<?php

namespace App\Controllers;

use App\Models\PropertyModel;
use App\Repositories\PropertyRepository;
use App\Services\PropertyService;
use CodeIgniter\API\ResponseTrait;
use CodeIgniter\HTTP\Request;
use Exception;

class PropertyController extends BaseController
{
    private $propertyService;

    use ResponseTrait;

    public function __construct()
    {
        // @todo since Codeigniter missing dependency injection via controller constructor, initialzing classes here. 
        // May be we can integrate a DI package later.
        $propertyModel = new PropertyModel();
        $propertyRepo = new PropertyRepository($propertyModel);
        $propertyService = new PropertyService($propertyRepo);
        $this->init($propertyService);
    }

    public function init(PropertyService $propertyService)
    {
        $this->propertyService = $propertyService;
    }


    public function getPropertyList()
    {
        try {
            return $this->loadPropertyList();
        } catch (Exception $e) {
            // Log exception to datadog or logger
        }
    }

    private function loadPropertyList()
    {
        if ($this->request->isAJAX()) {
            $viewName = 'property_data';
            $validation = \Config\Services::validation();
            $validation->setRules($this->getPropertyListValidationRules());

            $success = $validation->withRequest($this->request)->run();

            if (!$success) {
                $errors = $validation->getErrors();

                return $this->fail($errors, 400);
            }
        } else {
            $viewName = 'properties_list';
        }

        $requestParams = $this->formatRequestData();
        $data = $this->propertyService->getPropertyList($requestParams);

        return view($viewName, [
            'properties' =>  !empty($data) ? $data : []
        ]);
    }

    private function formatRequestData()
    {
        return [
            PropertyModel::FILTER_MIN_PRICE => $this->request->getVar(PropertyModel::FILTER_MIN_PRICE),
            PropertyModel::FILTER_MAX_PRICE => $this->request->getVar("maxPrice"),
            PropertyModel::FILTER_MIN_AREA => $this->request->getVar("minArea"),
            PropertyModel::FILTER_MAX_AREA => $this->request->getVar("maxArea"),
            'page' => $this->request->getVar("page"),
            'sortCondition' => $this->request->getVar("sort"),
        ];
    }

    private function getPropertyListValidationRules(): array
    {
        return [
            PropertyModel::FILTER_MIN_PRICE => 'if_exist|numeric|min_length[1]',
            PropertyModel::FILTER_MAX_PRICE => 'if_exist|numeric|min_length[1]',
            PropertyModel::FILTER_MIN_AREA => 'if_exist|numeric|min_length[1]',
            PropertyModel::FILTER_MAX_AREA => 'if_exist|numeric|min_length[1]',
        ];
    }
}
