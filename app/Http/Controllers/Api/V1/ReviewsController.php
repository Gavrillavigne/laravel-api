<?php

namespace App\Http\Controllers\Api\V1;

use App\Events\AddReviewNotification;
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
        $isAnswer = !empty($request->get('parent_id'));
        $isAdmin = $user->role == User::ADMINISTRATOR_ROLE_ID;
        $userId = null;

        if ($isAnswer && !$isAdmin) {
            return $this->sendError('Only an administrator can add an answer to a review!');
        }

        $data = $request->validated();
        $this->model->fill($data)->push();

        if ($isAnswer && $isAdmin) {
            $userId = $data['user_id'];
        }

        event(new AddReviewNotification($this->model, $userId));
        return $this->sendResponse($data, 'Created', 201);
    }

}
