<?php 

interface DAO{
	/**
	 * Handle 'get' operations
	 * @throws  Handle exception if fails
	 */
	public function get($id);
	/**
	 * Handle 'insert' operations
	 * @throws  Handle exception if fails
	 */
	public function insert($object);
	/**
	 * Handle 'delete' operations
	 * @throws  Handle exception if fails
	 */
	public function delete($object);
	/**
	 * Handle 'update' operations
	 * @throws  Handle exception if fails
	 */
	public function update($object);
	/**
	 * Handle 'getAll' operations
	 * @throws  Handle exception if fails
	 */
	public function getAll();
}


?>