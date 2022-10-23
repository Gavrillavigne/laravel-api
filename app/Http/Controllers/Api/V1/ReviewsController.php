<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Requests\GetReviewsRequest;
use App\Http\Requests\AddReviewRequest;
use App\Models\Review;
use App\Models\User;

class ReviewsController extends ApiController
{
    /**
     * ReviewsController constructor.
     * @param Review $model
     */
    public function __construct(Review $model)
    {
        $this->model = $model;
    }

    /**
     * @param GetReviewsRequest $request
     * @return string
     */
    public function getReviews(GetReviewsRequest $request)
    {
        $validateData = $request->validated();
        $result = $this->model->getReviews($validateData);

        return $this->sendResponse($result, 'OK', 200);
    }

    /**
     * @param AddReviewRequest $request
     * @return string
     */
    public function addReview(AddReviewRequest $request)
    {
        $user = $request->user();

        if (!empty($request->get('parent_id')) && $user->role != User::ADMINISTRATOR_ROLE_ID) {
            return $this->sendError('Only an administrator can add a response to a review!');
        }
        return parent::add($request);
    }

}
