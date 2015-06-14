<?php
/*
 * This file is part of the test-project package.
 *
 * (c) Eduostia Corporation <http://eduostia.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace App\Repositories;

use App\Entities\Entity;
use Illuminate\Database\Eloquent\Collection;


/**
 * @author      Iqbal Maulana <iq.bluejack@gmail.com>
 * @created     6/12/15
 */
interface RepositoryInterface {

    /**
     * @param string $id
     *
     * @return Entity
     *
     * @author Iqbal Maulana <iq.bluejack@gmail.com>
     */
    public function findById($id);

    /**
     * @param array $criteria
     *
     * @return Collection
     *
     * @author Iqbal Maulana <iq.bluejack@gmail.com>
     */
    public function find(array $criteria);

    /**
     * @return Collection
     *
     * @author Iqbal Maulana <iq.bluejack@gmail.com>
     */
    public function findAll();
}