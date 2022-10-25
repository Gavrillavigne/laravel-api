<?php

namespace App\Http\Requests;

use App\Models\Review;

class AddReviewRequest extends ApiRequest
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
            'text' => 'string',
            'approved' => 'in:' . Review::STATUS_ACTIVE . ',' . Review::STATUS_INACTIVE,
            'is_viewed' => 'in:' . Review::STATUS_ACTIVE . ',' . Review::STATUS_INACTIVE,
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
            'text.string' => 'text should be string!',
            'approved.in' => 'approved should be in' . Review::STATUS_ACTIVE . ',' . Review::STATUS_INACTIVE,
            'is_viewed.in' => 'is_viewed should be in' . Review::STATUS_ACTIVE . ',' . Review::STATUS_INACTIVE
        ];
    }

}
