<?php
/**
 * Created by Gemkids.
 * User: MSI
 * Date: 09/06/2018
 * Time: 15:36 PM
 */
namespace App\Backend\Services\Interfaces;

interface FoodServiceInterface
{
	//Food
	public function getFood($idStore);
	public function addFood($obj);
	public function getById($id);
	public function editFood($obj);
	public function deleteFood($id);
	public function deleteAllFood($arrId);
	public function getType($idStore);
	public function getMenu($idStore);
	public function getDataType();
}