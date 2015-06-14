<?php
/*
 * This file is part of the test-project package.
 *
 * (c) Eduostia Corporation <http://eduostia.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace App\Commands;

/**
 * @author      Iqbal Maulana <iq.bluejack@gmail.com>
 * @created     6/11/15
 */
class ApplyCreditCommand extends Command {

	public $loanAmount;
	public $tenor;
	public $fullName;
	public $email;
	public $phone;

	/**
	 * Command rules
	 *
	 * @var array
	 */
	protected $rules = [

		'loanAmount'    => 'required',
	    'tenor'         => 'required',
	    'fullName'      => 'required',
	    'email'         => 'required',
	    'phone'         => 'required'
	];

	/**
	 * @param double $loanAmount
	 * @param int    $tenor
	 * @param string $fullName
	 * @param string $email
	 * @param string $phone
	 */
	public function __construct($loanAmount, $tenor, $fullName, $email, $phone) {

		$this->loanAmount   = $loanAmount;
		$this->tenor        = $tenor;
		$this->fullName     = $fullName;
		$this->email        = $email;
		$this->phone        = $phone;

		$this->validate();
	}

	/**
	 * {@inheritDoc}
	 */
	public function serialize() {

		return [

			'loanAmount'    => $this->loanAmount,
		    'tenor'         => $this->tenor,
		    'fullName'      => $this->fullName,
		    'email'         => $this->email,
		    'phone'         => $this->phone
		];
	}
}