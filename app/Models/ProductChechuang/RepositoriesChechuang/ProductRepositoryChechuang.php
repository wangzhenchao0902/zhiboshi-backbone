<?php
namespace App\Models\ProductChechuang\Repositories;

use App\Models\ProductChechuang\ProductChechuang;
use App\Models\Base\BaseRepository;

class ProductRepositoryChechuang extends BaseRepository {
    
    /**
     * constructor
     *
     * @author suxiangdong
     * @date 2021-01-03
     * @param ProductChechuang $product
     */
    public function __construct(ProductChechuang $product) 
    {
        parent::__construct($product);
    }
    
    /**
     * create product
     *
     * @author suxiangdong
     * @date 2020-12-24
     * @param array $data
     * @return Product
     */
    public function createProductChechuang(array $data) : ProductChechuang
    {
        try {
            return $this->create($data);
        } catch (\Exception $e) {
            throw $e;
        }
    }

    /**
     * setUsed
     *
     * @author suxiangdong
     * @date 2021-01-15
     * @return void
     */
    public function setUsed($id)
    {
        if (!$product = $this->find($id)) {
            throw new \Exception('产品 '.$id.' 不存在');
        }

        $product->update(['status' => 1]);
    }

    /**
     * auto create product code
     *
     * @author suxiangdong
     * @date 2021-01-15
     * @param [type] $num
     * @return void
     */
    public function generate($num, $year, $complimentary)
    {
        while ($num > 0) {
            $sn = ProductChechuang::genSn();
            if ($this->findBySn($sn)) {
                continue;
            }
            
            $data = ['status' => 0, 'sn' => $sn, 'year' => $year, 'complimentary' => $complimentary];

            $this->createProductChechuang($data);
            $num--;
        }
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