<?php
/*
 * This file is part of the test-project package.
 *
 * (c) Eduostia Corporation <http://eduostia.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace App\Handlers\Commands;

use Illuminate\Events\Dispatcher;

/**
 * @author      Iqbal Maulana <iq.bluejack@gmail.com>
 * @created     6/11/15
 */
abstract class CommandHandler {

    /**
     * @var Dispatcher
     */
    protected $dispatcher;

    /**
     * Initialize new instance and set event dispatcher.
     *
     * @param Dispatcher $dispatcher
     */
    public function __construct(Dispatcher $dispatcher) {

        $this->dispatcher = $dispatcher;
    }
}