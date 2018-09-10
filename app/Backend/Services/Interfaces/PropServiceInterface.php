<?php
/**
 * Created by Gemkids.
 * User: MSI
 * Date: 09/06/2018
 * Time: 15:36 PM
 */
namespace App\Backend\Services\Interfaces;

interface PropServiceInterface
{
	//Prop
	public function getProp($idStore);
	public function addProp($obj);
	public function getById($id);
	public function editProp($obj);
	public function deleteProp($id);
	public function deleteAllProp($arrId);
	public function getType($idStore);
	public function getDataType();
}
