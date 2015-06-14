<?php
/*
 * This file is part of the test-project package.
 *
 * (c) Eduostia Corporation <http://eduostia.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace App\Events;

use App\Entities\Application;


/**
 * @author      Iqbal Maulana <iq.bluejack@gmail.com>
 * @created     6/12/15
 */
interface ShouldBeMailed {

    /**
     * @return string
     *
     * @author Iqbal Maulana <iq.bluejack@gmail.com>
     */
    public function getMessage();

    /**
     * @return Application
     *
     * @author Iqbal Maulana <iq.bluejack@gmail.com>
     */
    public function getApplication();
}