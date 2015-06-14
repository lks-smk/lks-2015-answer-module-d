<?php
/*
 * This file is part of the test-project package.
 *
 * (c) Eduostia Corporation <http://eduostia.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace App\Handlers\Events;

use App\Events\CreditWasRejected;

/**
 * @author      Iqbal Maulana <iq.bluejack@gmail.com>
 * @created     6/12/15
 */
class CreditWasRejectedEventHandler {

    use CreditMailer;

    /**
     * Handler when credit was applied
     *
     * @param CreditWasRejected $event
     *
     * @author Iqbal Maulana <iq.bluejack@gmail.com>
     */
    public function handle(CreditWasRejected $event) {

        $this->mail($event->getApplication(), $event->getMessage());
    }
}