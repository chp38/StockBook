<?php
/**
 * Created by PhpStorm.
 * User: charlespalmer
 * Date: 2019-03-21
 * Time: 17:21
 */

namespace App\Repositories\TradeDetails;

use App\Model\TradeDetail;
use App\Repositories\EloquentRepository;
use App\Repositories\RepositoryInterface;
use Illuminate\Database\Eloquent\Model;

class TradeDetailsRepository extends EloquentRepository implements RepositoryInterface
{
    /**
     * TradeDetailsRepository constructor.
     *
     * @param TradeDetail $model
     */
    public function __construct(TradeDetail $model)
    {
        parent::__construct($model);
    }
}