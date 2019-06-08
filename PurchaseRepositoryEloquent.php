<?php

namespace Modules\Core\Repositories\Eloquent;

use Modules\Core\Repositories\Contracts\PurchaseRepository;
use Modules\Core\Entities\Purchase;
use Modules\Core\Enums\ApprovalStatus;
use Modules\Core\Enums\TransactionStatus;

use DB;

/**
 * Class PurchaseRepositoryEloquent
 * @package namespace Modules\Core\Repositories\Eloquent;
 */
class PurchaseRepositoryEloquent extends InvoiceRepositoryEloquent implements PurchaseRepository
{
    public function model()
    {
        return Purchase::class; 
    }

    public function boot()
    {
        parent::boot();
        $this->setFieldSearchable(['supplier_id', 'deliver_to', 'deliver_until']);
    }

    /**
     * Find remaining list of invoices based on filters
     *
     * @param  int $branch
     * @param  string $sheetNumber
     * @return Model
     */
    public function findRemaining($branch, $sheetNumber = '')
    {
        // $model = $this->model
        //     ->where('sheet_number', 'LIKE', sprintf("%%%s%%", $sheetNumber))
        //     ->where('approval_status', ApprovalStatus::APPROVED)
        //     ->whereIn('transaction_status', array(TransactionStatus::INCOMPLETE, TransactionStatus::NO_DELIVERY));


        // $locations = DB::table('branch_detail')
        //     ->where('branch_id', $branch)
        //     ->get();

        // $model = $model->where(function($query) use($branch, $locations) {
        //     if (!setting('purchase.inbound.display.purchase.other.branches')) {
        //         $query->where('created_for', $branch);
        //     }

        //     foreach ($locations as $location) {
        //         $query->orWhere('deliver_to', $location->id);
        //     }
        // });

        // $model = $model->orderBy('transaction_date', 'desc')
        //     ->limit(10)
        //     ->get();

        // $this->resetModel();

        return "test";
    }

    public function getInvoicesForSelector($branch, $limit = null)
    {
        return "test";
    }
}