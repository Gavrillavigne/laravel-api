<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    const STATUS_ACTIVE = 1;
    const STATUS_INACTIVE = 0;
    const LIMIT_DEFAULT = 100;
    const OFFSET_DEFAULT = 0;

    protected $table = 'review';

    protected $fillable = [
        'parent_id',
        'user_id',
        'text'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function user()
    {
        return $this->hasOne(User::class);
    }

    /**
     * @param array $data
     * @return \Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection
     */
    public function getReviews(array $data)
    {
        $model = $this->query();

        if (!empty($data['parent_id'])) {
            $model->where('parent_id', $data['parent_id']);
        }

        if (!empty($data['user_id'])) {
            $model->where('user_id', $data['user_id']);
        }

        if (!empty($data['is_viewed'])) {
            $model->where('is_viewed', $data['is_viewed']);
        }

        $limit = $data['limit'] ?? self::LIMIT_DEFAULT;
        $offset = $data['offset'] ?? self::OFFSET_DEFAULT;

        return $model->offset($offset)->limit($limit)->get();
    }

}
