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
class EntityException extends \InvalidArgumentException {

	/**
	 * @param $errors
	 *
	 * @author Iqbal Maulana <iq.bluejack@gmail.com>
	 */
	public static function errorValidate($errors) {

		throw new EntityException(implode(' ', $errors));
	}
}