<?php
namespace App\Models\Warranty\Repositories;

use App\Models\Warranty\Warranty;
use App\Models\Base\BaseRepository;
use App\Models\Product\Product;
use Carbon\Carbon;

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
        var_dump($data);
        try {
            $now = Carbon::now();

            $data = array_merge($data, [
                'start_at' => $now,
                'end_at' => $now->copy()->addYears($data->year),
            ]);
            $warranty = $this->create($data);
            $warranty->product->registerWarranty($warranty);
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
    public function findByProduct(Product $product)
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