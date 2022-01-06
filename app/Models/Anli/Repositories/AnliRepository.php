<?php
namespace App\Models\Anli\Repositories;

use App\Models\Anli\Anli;
use App\Models\Base\BaseRepository;

class AnliRepository extends BaseRepository {
    
    /**
     * constructor
     *
     * @author suxiangdong
     * @date 2021-01-03
     * @param Anli $anli
     */
    public function __construct(Anli $anli) 
    {
        parent::__construct($anli);
    }
    
    /**
     * create anli
     *
     * @author suxiangdong
     * @date 2020-12-24
     * @param array $data
     * @return Anli
     */
    public function createAnli(array $data) : Anli
    {
        try {
            return $this->create($data);
        } catch (\Exception $e) {
            throw $e;
        }
    }

    /**
     * Undocumented function
     *
     * @author suxiangdong
     * @date 2021-01-24
     * @return void
     */
    public function getAbout()
    {
        return $this->model->where('category_id', 3)->orderBy('id', 'desc')->first();
    }

    /**
     * Undocumented function
     *
     * @author suxiangdong
     * @date 2021-01-24
     * @return void
     */
    public function getContact()
    {
        return $this->model->where('category_id', 4)->orderBy('id', 'desc')->first();
    }

    /**
     * Undocumented function
     *
     * @author suxiangdong
     * @date 2021-01-03
     * @param [type] $id
     * @return void
     */
    public function find($id)
    {
        return $this->findOneOrFail($id);
    }

    /**
     * Undocumented function
     *
     * @author suxiangdong
     * @date 2021-01-10
     * @param array $ids
     * @return void
     */
    public function deleteByIds(array $ids = [])
    {
        return $this->model->whereIn('id', $ids)->delete();
    }
}