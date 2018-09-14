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
	public function getFood($idStore);//Lấy các món ăn về
	public function addFood($obj);//Thêm Món Ăn
	public function addProp($obj);//Thêm thuộc tính
	public function addPropValue($obj);//Thêm thuộc tính trog bảng property_value
	public function getById($id);//Lấy món ăn về chỉnh sửa
	public function editFood($obj);
	public function editPropValue($obj);
	public function getType($idStore);//Lấy thể loại món ăn
	public function getProp($idType);//Lấy các thuộc tính của món ăn
	public function getPropByFood($idFood);//Lấy thuộc tính theo món ăn
	public function getMenu($idStore);//Lấy menu món ăn
	public function getDataType();//Lấy kiểu dữ liệu của thuộc tính
	public function deleteFood($id);
	public function deleteFoodProp($id);//Xóa thuộc tính của món ăn
	public function deleteAllFood($arrId);
}
