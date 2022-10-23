<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\ApiRequest;
use Illuminate\Database\Eloquent\Model;

class ApiController extends Controller
{
    /**
     * @var Model
     */
    protected $model;

    /**
     * @param ApiRequest $request
     * @return mixed
     */
    protected function add(ApiRequest $request)
    {
        $data = $request->validated();
        $this->model->fill($data)->push();

        return $this->sendResponse(null, 'Created', 201);
    }

}
