<?php
/**
 * Created by Gemkids.
 * User: MSI
 * Date: 09/06/2018
 * Time: 15:36 PM
 */
namespace App\Backend\Services\Interfaces;

interface StoreServiceInterface
{
	//Store
	public function addStore($obj);
	public function getMyStore($storeId);
	public function editStore($obj);
}
