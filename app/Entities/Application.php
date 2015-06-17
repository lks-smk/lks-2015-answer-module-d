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

use App\Repositories\DebtRepository;

/**
 * @author      Iqbal Maulana <iq.bluejack@gmail.com>
 * @created     6/11/15
 */
class Application extends Entity {

    const APPLICATION_STATUS_PENDING = -1;
    const APPLICATION_STATUS_ACCEPTED = 1;
    const APPLICATION_STATUS_REJECTED = 0;

    /**
     * Table name
     *
     * @var string
     */
    protected $table = 'application';

    /**
     * Table identity
     *
     * @var string
     */
    protected $primaryKey = 'request_id';

    /**
     * Table column mapping
     *
     * @var array
     */
    protected $maps = [

        'requestId'      => 'request_id',
        'requestDate'    => 'request_date',
        'loanAmount'     => 'loan_amount',
        'tenor'          => 'tenor',
        'email'          => 'email',
        'phone'          => 'phone',
        'interestRate'   => 'interest_rate',
        'monthlyPayment' => 'monthly_payment',
        'fullName'       => 'full_name',
        'isApproved'     => 'is_approved',
        'approveDate'    => 'approve_date',
        'approveBy'      => 'approve_by'
    ];

    /**
     * @var array
     */
    protected $guarded = ['request_id'];

    /**
     * Initialize instance and configuration
     */
    public function __construct() {

        //Configure fill able entity only from mapping field column
        $this->fillable(array_values($this->maps));
    }

    /**
     * Request apply credit
     *
     * @param array $data
     *
     * @return Application
     *
     * @author Iqbal Maulana <iq.bluejack@gmail.com>
     */
    public static function applyCredit(array $data) {

        $application = new Application();
        $requestId   = new RequestId();

        $application->fill($data);
        $application->setMonthlyPayment(2);

        $application->requestId   = (string) $requestId;
        $application->isApproved  = Application::APPLICATION_STATUS_PENDING;
        $application->requestDate = (new \DateTime())->format('Y-m-d');

        if ($application->save()) {

            $application->requestId = $requestId;
            Debt::applyDebt($application);

            return $application;
        }

        throw new \RuntimeException('Failed during apply credit.');
    }

    /**
     * Set monthly payment
     *
     * @param integer $interestRate
     *
     * @author Iqbal Maulana <iq.bluejack@gmail.com>
     */
    public function setMonthlyPayment($interestRate) {

        $this->interestRate = $interestRate;

        $interestRate = $this->interestRate / 1200;

        $this->monthlyPayment = $interestRate * -$this->loanAmount * pow((1 + $interestRate), $this->tenor) / (1 - pow(
                    (1 + $interestRate), $this->tenor
                ));
    }

    /**
     * Accept application
     *
     * @param string $acceptBy
     *
     * @return boolean
     *
     * @author Iqbal Maulana <iq.bluejack@gmail.com>
     */
    public function accept($acceptBy) {

        $this->isApproved  = Application::APPLICATION_STATUS_ACCEPTED;
        $this->approveDate = (new \DateTime())->format('Y-m-d');
        $this->approveBy   = $acceptBy;

        return $this->where('request_id', $this->requestId)->update($this->attributes);
    }

    /**
     * Reject application
     *
     * @return boolean
     *
     * @author Iqbal Maulana <iq.bluejack@gmail.com>
     */
    public function reject() {

        $this->isApproved = Application::APPLICATION_STATUS_REJECTED;

        return $this->where('request_id', $this->requestId)->update($this->attributes);
    }

    /**
     * @return DebtRepository
     *
     * @author Iqbal Maulana <iq.bluejack@gmail.com>
     */
    public function debts() {

        return $this->lazyHasMany(DebtRepository::class, 'request_id');
    }
}