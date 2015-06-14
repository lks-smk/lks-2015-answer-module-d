<?php
/*
 * This file is part of the test-project package.
 *
 * (c) Eduostia Corporation <http://eduostia.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace App\Http\Controllers;

/**
 * @author      Iqbal Maulana <iq.bluejack@gmail.com>
 * @created     6/10/15
 */
class HomeController extends Controller {

    public function index() {

        return view('index');
    }
}