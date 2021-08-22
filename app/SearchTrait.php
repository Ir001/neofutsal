<?php

namespace App;

use Illuminate\Support\Facades\Schema;

trait SearchTrait
{
    /**
     * @param \Illuminate\Database\Eloquent\Builder|static $query
     * @param string $keyword
     * @param boolean $matchAllFields
     */
    public static function scopeSearch($query, $keyword, $matchAllFields = false)
    {
        return static::where(function ($query) use ($keyword, $matchAllFields) {

            foreach (static::getSearchFields() as $field) {
                if ($matchAllFields) {
                    $query->where($field, 'LIKE', "%$keyword%");
                } else {
                    $query->orWhere($field, 'LIKE', "%$keyword%");
                }
            }

        });
    }

    /**
     * Get all searchable fields
     *
     * @return array
     */
    public static function getSearchFields()
    {
        $model = new static;

        $fields = $model->search;

        if (empty($fields)) {
            $fields = Schema::getColumnListing($model->getTable());

            $others[] = $model->primaryKey;

            $others[] = $model->getUpdatedAtColumn() ?: 'created_at';
            $others[] = $model->getCreatedAtColumn() ?: 'updated_at';

            $others[] = method_exists($model, 'getDeletedAtColumn')
                ? $model->getDeletedAtColumn()
                : 'deleted_at';

            $fields = array_diff($fields, $model->getHidden(), $others);
        }

        return $fields;
    }
}