<?php
/*
 * This file is part of the test-project package.
 *
 * (c) Eduostia Corporation <http://eduostia.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Repositories\ApplicationRepositoryInterface;

/**
 * @author      Iqbal Maulana <iq.bluejack@gmail.com>
 * @created     6/12/15
 */
class TopApplicationController extends Controller {

    protected $repo;

    /**
     * @param ApplicationRepositoryInterface $repo
     */
    public function __construct(ApplicationRepositoryInterface $repo) {

        $this->repo = $repo;
    }

    /**
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @author Iqbal Maulana <iq.bluejack@gmail.com>
     */
    public function index() {

        return response()->json($this->repo->findTopApprovedApplications());
    }
}