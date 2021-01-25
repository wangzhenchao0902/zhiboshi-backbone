<?php
namespace App\Models\Warranty\Repositories;

use App\Models\Warranty\Warranty;
use App\Models\Base\BaseRepository;

class WarrantyRepository extends BaseRepository {
    
    /**
     * constructor
     *
     * @author suxiangdong
     * @date 2021-01-03
     * @param Warranty $warranty
     */
    public function __construct(Warranty $warranty) 
    {
        parent::__construct($warranty);
    }
    
    /**
     * create warranty
     *
     * @author suxiangdong
     * @date 2020-12-24
     * @param array $data
     * @return Warranty
     */
    public function createWarranty(array $data) : Warranty
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
     * @date 2021-01-17
     * @param [type] $id
     * @return void
     */
    public function void($id)
    {
        if (!$warranty = $this->find($id)) {
            throw new \Exception('未找到授权');
        }

        $warranty->status = 2;
        $warranty->save();
    }

    /**
     * find by sn
     *
     * @author suxiangdong
     * @date 2021-01-15
     * @param [type] $sn
     * @return void
     */
    public function findBySn($sn)
    {
        return $this->model->where('sn', $sn)->first();
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