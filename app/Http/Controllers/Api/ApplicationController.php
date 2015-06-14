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

use App\Commands\ApplyCreditCommand;
use App\Entities\Application;
use App\Http\Controllers\Controller;
use App\Repositories\ApplicationRepository;
use App\Repositories\ApplicationRepositoryInterface;
use Illuminate\Http\Request;

/**
 * @author      Iqbal Maulana <iq.bluejack@gmail.com>
 * @created     6/11/15
 */
class ApplicationController extends Controller {

    /**
     * @var ApplicationRepository
     */
    protected $repo;

    /**
     * Initialize new instance
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

        return response()->json($this->repo->findPendingApplications());
    }

    /**
     * @param string $requestId
     *
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @author Iqbal Maulana <iq.bluejack@gmail.com>
     */
    public function show($requestId) {

        /** @var Application $credit */
        $credit        = $this->repo->findById($requestId);
        $credit->debts = $credit->debts()->findAll();

        return response()->json($credit);
    }

    /**
     * @param Request $request
     *
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @author Iqbal Maulana <iq.bluejack@gmail.com>
     */
    public function store(Request $request) {

        $code = 200;

        try {

            $this->dispatchFrom(ApplyCreditCommand::class, $request);

            $response = ['success' => true, 'message' => 'Data has been stored.'];
        } catch (\InvalidArgumentException $e) {

            $code     = 400;
            $response = ['success' => false, 'message' => $e->getMessage()];
        }

        return response()->json($response, $code);
    }
}