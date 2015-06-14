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

use App\Entities\Application;
use Illuminate\Support\Facades\Mail;


/**
 * @author      Iqbal Maulana <iq.bluejack@gmail.com>
 * @created     6/12/15
 */
trait CreditMailer {

    /**
     * Mail credit helper
     *
     * @param Application $application
     * @param string      $message
     *
     * @author Iqbal Maulana <iq.bluejack@gmail.com>
     */
    public function mail(Application $application, $message) {

        Mail::raw(
            $message, function ($mail) use (&$application) {

            $mail->from('sa@localhost', 'Your Credit Information');
            $mail->to($application->email);
        }
        );
    }
}