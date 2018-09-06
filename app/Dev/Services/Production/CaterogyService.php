<?php
/**
 * Created by PhpStorm.
 * User: MSI
 * Date: 8/3/2018
 * Time: 10:44 AM
 */

namespace App\Dev\Services\Production;

use App\Dev\Dao\DEVDB;
use App\Dev\Services\Interfaces\CategoryServiceInterface;
use App\Dev\Entities\DataResultCollection;
class CaterogyService extends BaseService implements CategoryServiceInterface
{
    public function getCategoryWithLevelList():DataResultCollection
    {
        return DEVDB::execSPsToDataResultCollection('DEBUG_GET_CATEGORY_WITH_LEVEL_LIST');
    }
    public function categoryAddChildInLeft($paramArr):DataResultCollection{
        return DEVDB::execSPsToDataResultCollection('DEBUG_CATELORY_ADD_CHILD_IN_LEFT',$paramArr);
    }

    public function categoryUpdateMenu($paramArr):DataResultCollection {
        return DEVDB::execSPsToDataResultCollection('DEBUG_CATELORY_UPDATE',$paramArr);
    }

    public function categoryDeleteNodeAndChild($nodeId):DataResultCollection{
        return DEVDB::execSPsToDataResultCollection('DEBUG_CATELORY_DELETE_NODE_AND_CHILD',array($nodeId));
    }
}
