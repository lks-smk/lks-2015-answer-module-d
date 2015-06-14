<?php
/*
 * This file is part of the test-project package.
 *
 * (c) Eduostia Corporation <http://eduostia.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace App\Entities;

/**
 * @author      Iqbal Maulana <iq.bluejack@gmail.com>
 * @created     6/11/15
 */
class Debt extends Entity {

    /**
     * Table name
     *
     * @var string
     */
    protected $table = 'detail_application';

    /**
     * Table identity
     *
     * @var string
     */
    protected $primaryKey = 'detail_id';

    /**
     * Hidden fields
     *
     * @var array
     */
    protected $hidden = ['request_id'];

    /**
     * Table column mapping
     *
     * @var array
     */
    protected $maps
        = [

            'detailId'      => 'detail_id',
            'requestId'     => 'request_id',
            'paymentDate'   => 'payment_date',
            'paymentAmount' => 'payment_amount',
            'principalDebt' => 'principal_debt'
        ];

    /**
     * Apply debt credit
     *
     * @param Application $application
     *
     * @author Iqbal Maulana <iq.bluejack@gmail.com>
     */
    public static function applyDebt(Application $application) {

        $debts = [];

        for ($i = 0; $i < $application->tenor; $i++) {

            $balance = $i == 0 ? $application->loanAmount : $debts[ $i - 1 ]->balance;

            $debt                = new Debt();
            $debt->requestId     = $application->requestId;
            $debt->paymentAmount = $application->monthlyPayment;
            $debt->interest      = ($balance * 2) / 1200;
            $debt->principalDebt = $application->monthlyPayment - $debt->interest;
            $debt->balance       = $balance - $debt->principalDebt;
            $debt->paymentDate   = date('Y-m-d', strtotime(sprintf('+%d month', $i + 1)));

            $debt->save();

            $debts[] = $debt;
        }
    }
}