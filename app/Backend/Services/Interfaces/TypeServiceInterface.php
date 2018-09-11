<?php
/**
 * Created by Gemkids.
 * User: MSI
 * Date: 09/06/2018
 * Time: 15:36 PM
 */
namespace App\Backend\Services\Interfaces;

interface TypeServiceInterface
{
	//Type
	public function getType($idStore);
	public function getProp($idType);
	public function getDataType();
	public function addType($obj);
	public function addProp($obj);
	public function getById($id);
	public function editType($obj);
	public function editProp($obj);
	public function deleteType($id);
	public function deleteAllType($arrId);
	public function deleteProp($id);

}
