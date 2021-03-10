<?php

namespace App\Repositories;

use App\Models\Role;
use Illuminate\Http\Request;

class RoleRepository
{
    /**
     * Eloquent model instance
     */
    protected $model;

    /**
     * Load default class depedencies.
     *
     * @model Model model Illuminate\Database\Eloquent\Model
     */
    public function __construct(Role $model)
    {
        $this->model = $model;
    }

    /**
     * Get all item collections from database
     *
     * @return Collection of items
     */
    public function getAll()
    {
        return $this->model->orderBy('id', 'desc')->get();
    }

    /**
     * Get item collection by id
     *
     * @return single item
     */
    public function getByID($branchID)
    {
        return $this->model->findOrFail($branchID);
    }

    /**
     * Create new record
     *
     * @param Request $request Illuminate\Http\Request
     * @return saved model object with data
     */
    public function store(Request $request)
    {
        $data = $this->setDataPayload($request);
        $item = $this->model;
        $item->fill($data);
        $item->save();

        return $item;
    }

    /**
     * Update existing data
     *
     * @param Integer $id integer item primary key
     * @param Request $request Illuminate\Http\Request
     * @return send updated item object.
     */
    public function update($roleID, Request $request)
    {
        $data = $this->setDataPayload($request);
        $item = $this->model->findOrFail($roleID);
        $item->fill($data);
        $item->save();

        return $item;
    }

    /**
     * Delete item by primary key id.
     *
     * @param  Integer $id integer of primary key id.
     * @return boolean
     */
    public function delete($branchID)
    {
        return $this->model->destroy($branchID);
    }

    /**
     * set data for saving
     *
     * @param  Request $request Illuminate\Http\Request
     * @return array of data.
     */
    protected function setDataPayload(Request $request)
    {
        return $request->all();
    }
}