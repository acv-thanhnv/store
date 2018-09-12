<?php
/**
 * Created by Gemkids.
 * User: MSI
 * Date: 09/06/2018
 * Time: 15:36 PM
 */
namespace App\Backend\Services\Interfaces;

interface MenuServiceInterface
{
	//Menu
	public function getMenu($idStore);
	public function addMenu($obj);
	public function getById($id);
	public function editMenu($obj);
	public function deleteMenu($id);
	public function deleteAllMenu($arrId);
}
