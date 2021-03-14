<?php

namespace App\Models\Stores;

use App\Models\Stores\Store;
use Illuminate\Database\Eloquent\Model;
use App\Models\BaseRepository;

class StoresRepository extends BaseRepository
{
    /**
	 * @var Model
	 */
	protected $model;

    public function __construct(Store $model)
	{
		$this->model = $model;
	}
}