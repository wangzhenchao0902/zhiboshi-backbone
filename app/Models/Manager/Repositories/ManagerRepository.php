<?php
namespace App\Models\Manager\Repositories;

use App\Models\Manager\Manager;
use App\Models\Base\BaseRepository;
use Hash, Arr;

class ManagerRepository extends BaseRepository {
    
    public function __construct(Manager $manager) 
    {
        parent::__construct($manager);
    }

    /**
     * default manager
     *
     * @author suxiangdong
     * @date 2020-12-24
     * @return void
     */
    public function createSuperManager()
    {
        $this->createManager('admin', 'admin', $data);
    }
    
    /**
     * create manager
     *
     * @author suxiangdong
     * @date 2020-12-24
     * @param array $data
     * @return Manager
     */
    public function createManager($name, $password, array $data) : Manager
    {
        $managerData = [
            'name' => $name,
            'password' => Hash::make($password),
        ];
        
        if ($this->model->where('name', $name)->first()) {
            throw new \Exception('用户名重复');
        }

        try {
            return $this->create(array_merge($managerData, $data));
        } catch (\Exception $e) {
            throw $e;
        }
    }

    /**
     * update manager
     *
     * @author suxiangdong
     * @date 2021-01-12
     * @param [type] $data
     * @return void
     */
    public function updateManager($data)
    {
        if ($password = Arr::get($data, 'password')) {
            $data['password'] = Hash::make($password);
        }

        if ($name = Arr::get($data, 'name')) {
            if ($this->model->where('name', $name)->first()) {
                throw new \Exception('用户名重复');
            }
        }

        try {
            return $this->model->update($data);
        } catch (\Exception $e) {
            throw $e;
        }
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
     * delete
     *
     * @author suxiangdong
     * @date 2021-01-12
     * @param array $ids
     * @return void
     */
    public function deleteByIds(array $ids = [])
    {
        if (in_array(1, $ids)) {
            throw new \Exception('超级管理员不能删除');
        }
        
        return $this->model->whereIn('id', $ids)->delete();
    }
}