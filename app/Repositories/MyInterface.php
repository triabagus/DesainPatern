<?php
/**
 * Created by Tria Bagus.
 * User: topx
 * Date: 09.07.19
 * Time: 14:47
 */

namespace App\Repositories;

interface MyInterface
{
    /**
     * Get all
     *
     * @return mixed
     */
    function getAll();

    /**
     * Get by id
     *
     * @param int $id
     * @return mixed
     */
    function getById(int $id);
    /**
     * Create new
     *
     * @param array $attributes
     * @return mixed
     */
    function create(array $attributes);
    /**
     * Update
     *
     * @param int $id
     * @param array $attributes
     * @return mixed
     */
    function update(int $id,array $attributes);
    /**
     * Destroy
     *
     * @param int $id
     * @return mixed
     */
    function delete(int $id);
    function deleteImageExpired($attributes);
    function allData();
}


