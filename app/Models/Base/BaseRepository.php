<?php
namespace App\Models\Base;

use Illuminate\Database\Eloquent\Model;
use Jsdecena\Baserepo\BaseRepository as Repository;

class BaseRepository extends Repository {

    public function __construct(Model $model)
    {
        parent::__construct($model);
    }

    /**
     * set model
     *
     * @author suxiangdong
     * @date 2021-01-06
     * @return void
     */
    public function setModel(Model $model)
    {
        $this->model = $model;
    }

    /**
     * Undocumented function
     *
     * @author suxiangdong
     * @date 2021-01-24
     * @param [type] $conditions
     * @param array $columns
     * @return void
     */
    public function get($conditions, $columns = ['*'])
    {
        $query = $this->model->select($columns);
        if ($conditions) {
            foreach ($conditions as $key => $value) {
                if (is_null($value)) {
                    continue;
                }
                if (is_array($value) && count($value) == 3) {
                    $query->where($value[0], $value[1], $value[2]);
                    continue;
                } else {
                    $query->where($key, $value);
                }
            }
        }

        return $query->get();
    }

    /**
     * paginate
     *
     * @author suxiangdong
     * @date 2021-01-03
     * @param integer $per_page
     * @param array $conditions
     * @param string $order
     * @param string $sort
     * @param array $columns
     * @return void
     */
    public function paginate(int $per_page = 100, array $conditions = [], string $order = 'id', string $sort = 'desc', array $columns = ['*'])
    {
        $query = $this->model->select($columns);

        if ($conditions) {
            foreach ($conditions as $key => $value) {
                if (is_null($value)) {
                    continue;
                }
                if (is_array($value) && count($value) == 3) {
                    $query->where($value[0], $value[1], $value[2]);
                    continue;
                } else {
                    $query->where($key, $value);
                }
            }
        }

        return $query->orderBy($order, $sort)->paginate($per_page);
    }

}