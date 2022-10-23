<?php

namespace App\Http\Requests;

use App\Models\Review;

class GetReviewsRequest extends ApiRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'parent_id' => 'int',
            'user_id' => 'int',
            'is_viewed' => 'in:' . Review::STATUS_ACTIVE . ',' . Review::STATUS_INACTIVE,
            'offset' => 'int',
            'limit' => 'int'
        ];
    }

    /**
     * Custom message for validation
     *
     * @return array
     */
    public function messages(): array
    {
        return [
            'parent_id.int' => 'parent_id id should be integer',
            'user_id.int' => 'user_id should be integer',
            'is_viewed.in' => 'is_viewed should be in' . Review::STATUS_ACTIVE . ',' . Review::STATUS_INACTIVE,
            'limit.int' => 'limit should be integer',
            'offset.int' => 'offset should be integer',
        ];
    }

}
