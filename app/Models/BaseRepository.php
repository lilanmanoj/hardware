<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
class BaseRepository
{
	public function searchPaginate($query)
	{
		$fields = $this->model->toSearchableArray();

		$where = [];

		foreach($fields as $index => $field) {
			$where[$index] = [
				$field,
				'like',
				'%'.$query.'%'
			];
		}

		return $this->model->orWhere($where)->paginate();
	}

	/**
     * Get the searchable data array for the model.
     *
     * @return array
     */
    public function toSearchableArray()
    {
        $array = $this->model->searchable;

        return $array;
    }
}