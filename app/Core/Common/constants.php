<?php

/**
 * Created by PhpStorm.
 * User: MSI
 * Date: 6/21/2018
 * Time: 10:26 AM
 */
namespace App\Core\Common;
class SDBStatusCode
{
    const OK = 'OK';
    const DataNull = 'DataNull';
    const Excep = 'Excep';
    const ApiError = 'ApiError';
    const WebError = 'WebError';
    const ACLNotPass = 'ACLNotPass';
    const ApiAuthNotPass = 'ApiAuthNotPass';
    const PDOExceoption = 'PDOExceoption';
    const ValidateError = 'ValidateError';
}

class FoodConst
{
    const foodPerPage = 12;
}

class ApiConst
{
    const ApiAccessTokenParamName = 'access_token';
    const ApiRefreshTokenParamName = 'refresh_token';
    const ApiModuleName = 'api';
}


class CoreConst
{
    const CoreModuleName = 'Core';
}

class RoleConst
{
    const PartyRole = 10;
    const PublicRole = 0;
    const SysAdminRole = 1;
    const UserWaittingAccept = 3;
}

class UploadConst
{
    /*
     * Type image allow access
     */
    const FILE_IMAGE_UPLOAD_ACCESSED = 'png,jpg,jpeg,bmp,gif';
    const UPLOAD_IMAGE_MAX = '5120'; // 5MB
    const BACKEND_UPLOAD_IMAGE_PDF_MAX = '32768'; // 32MB
    const BACKEND_UPLOAD_IMAGE_MAX = '5120'; // 5MB
    const UPLOAD_VIDEO_MAX = '1048576'; // 1GB
    const BACKEND_UPLOAD_VIDEO_MAX = '512000'; // 500MB
}

class LoggingConst
{
    const SQL_LOG_channel = 'sql_query';
}
class OrderConst{

    const CashierChannelToCashier    = "cashier2cashier";
    
    const Customer2Order             = "customer2order";
    
    const PaymentDoneEventName       = "payment-done";
    
    const UpdateOrderCooked          = "update-order-cooked";
    
    const OrderChannelToOrderManager = "customer-to-order-manager";
    
    const OrderChannelToCashier      = "customer2cashier";
    
    
    const NewOrderToOrderManager     = "new-order-to-order-manager";
    
    const OrderChannelToWaiter       = "waiter2waiter";
    const OrderEventName             = "order.waiter";
    
    
    const OrderChannelToChef         = "order2chef";
    const OrderChefEventName         = "new-order";
    
    const CustomerCashierEventName   = "new-payment";
    
    const OrderStatusEventName       = "order-status";
    
    
    const TypeDelete                 = "delete";
    const TypeAdd                    = "add";
    const TypeClearTrash             = "clear_trash";
}
class EntityProperty{
    const maxField = 10;
}
class StorageDisk{
    const diskLocalName = "public";
}
class CutomerConst{
    const limit = 5;
    const numberMenu = 5;
    const hour = 2;
}
class OrderStatusValue{
    const Waiter = 1;
    const Cheft = 2;
    const Close = 3;
    const Deleted = 10;
}
