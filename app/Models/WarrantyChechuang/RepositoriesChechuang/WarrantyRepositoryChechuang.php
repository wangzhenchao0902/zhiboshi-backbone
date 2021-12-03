<?php
namespace App\Models\WarrantyChechuang\RepositoriesChechuang;

use App\Models\WarrantyChechuang\WarrantyChechuang;
use App\Models\Base\BaseRepository;
use App\Models\ProductChechuang\ProductChechuang;
use Carbon\Carbon;

class WarrantyRepositoryChechuang extends BaseRepository {
    
    /**
     * constructor
     *
     * @author suxiangdong
     * @date 2021-01-03
     * @param WarrantyChechuang $warranty
     */
    public function __construct(WarrantyChechuang $warranty) 
    {
        parent::__construct($warranty);
    }
    
    /**
     * create warranty
     *
     * @author suxiangdong
     * @date 2020-12-24
     * @param array $data
     * @return WarrantyChechuang
     */
    public function createWarrantyChechuang(array $data) : WarrantyChechuang
    {
        $year = $data['year'];
        try {
            $now = Carbon::now();

            $data = array_merge($data, [
                'start_at' => $now,
                'end_at' => $now->copy()->addYears($year),
            ]);
            $warranty = $this->create($data);
            $warranty->product->registerWarrantyChechuang($warranty);
            return $warranty;
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
    public function findByProductChechuang(ProductChechuang $product)
    {
        return $this->model->where('product_id', $product->id)->first();
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