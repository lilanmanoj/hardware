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
}