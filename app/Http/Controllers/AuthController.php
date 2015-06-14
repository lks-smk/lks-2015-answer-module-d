<?php
/*
 * This file is part of the Module D package.
 *
 * (c) Eduostia Corporation <http://eduostia.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace App\Http\Controllers;

use App\Entities\User;
use App\Http\Requests\LoginRequest;
use Illuminate\Contracts\Auth\Guard;

/**
 * @author      Iqbal Maulana <iq.bluejack@gmail.com>
 * @created     6/15/15
 */
class AuthController extends Controller {

    /**
     * the model instance
     *
     * @var User
     */
    protected $user;

    /**
     * The Guard implementation.
     *
     * @var Guard
     */
    protected $auth;

    /**
     * @param Guard $auth
     * @param User  $user
     */
    public function __construct(Guard $auth, User $user) {

        $this->auth = $auth;
        $this->user = $user;

        $this->middleware('guest', ['except' => ['getLogout']]);
    }

    /**
     * Show login form
     *
     * @return \Illuminate\View\View
     *
     * @author Iqbal Maulana <iq.bluejack@gmail.com>
     */
    public function getLogin() {

        return view('auth.login');
    }

    /**
     * @param LoginRequest $request
     *
     * @return $this|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     *
     * @author Iqbal Maulana <iq.bluejack@gmail.com>
     */
    public function postLogin(LoginRequest $request) {

        if ($this->auth->attempt($request->only('email', 'password'))) {
            return redirect('/#/dashboard');
        }

        return redirect('/auth/login')->withErrors(
            [
                'email' => 'The credentials you entered did not match our records. Try again?',
            ]
        );
    }

    /**
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     *
     * @author Iqbal Maulana <iq.bluejack@gmail.com>
     */
    public function getLogout() {

        $this->auth->logout();

        return redirect('/');
    }
}