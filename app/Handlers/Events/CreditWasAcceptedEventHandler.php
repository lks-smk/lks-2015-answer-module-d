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

use App\Events\CreditWasAccepted;

/**
 * @author      Iqbal Maulana <iq.bluejack@gmail.com>
 * @created     6/12/15
 */
class CreditWasAcceptedEventHandler {

    use CreditMailer;

    /**
     * Handler when credit was accepted
     *
     * @param CreditWasAccepted $event
     *
     * @author Iqbal Maulana <iq.bluejack@gmail.com>
     */
    public function handle(CreditWasAccepted $event) {

        $this->mail($event->getApplication(), $event->getMessage());
    }
}