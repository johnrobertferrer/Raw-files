<?php

namespace Modules\Core\Entities;

class Purchase extends Invoice
{
    protected $table = 'purchase';

    public function details()
    {
        return $this->hasMany(PurchaseDetail::class, 'transaction_id');
    }

    public function supplier()
    {
        return $this->belongsTo(Supplier::class, 'supplier_id')->withTrashed();
    }

    public function deliverTo()
    {
        return $this->belongsTo(BranchDetail::class, 'deliver_to')->withTrashed();
    }

    public function payment()
    {
        return $this->belongsTo(PaymentMethod::class, 'payment_method')->withTrashed();
    }

    public function transactionable()
    {
        return $this->morphTo();
    }

    public function getSheetNumberPrefixAttribute()
    {
        return setting('purchase.sheet.number.prefix');
    }

    public function imports()
    {
        return $this->hasMany(PurchaseInbound::class, 'reference_id');
    }

    public function relationships()
    {
        return array_merge(
            parent::relationships(), 
            [   
                'detail' => [
                    'class' => PurchaseDetail::class,
                    'relation' => 'details'
                ],
                'supplier' => [
                    'class' => Supplier::class,
                    'relation' => 'supplier'
                ],
                'deliver_to' => [
                    'class' => BranchDetail::class,
                    'relation' => 'deliverTo'
                ],
                'payment_method' => [
                    'class' => PaymentMethod::class,
                    'relation' => 'payment'
                ],
            ]
        );
    }

    public function getCasts()
    {
        return array_merge(parent::getCasts(), [
            'supplier_id' => 'int',
            'payment_method' => 'int',
            'deliver_to' => 'int',
            'deliver_until' => 'date',
            'term' => 'int',
            'transactionable_id' => 'int'
        ]);
    }
}
