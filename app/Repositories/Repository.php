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
use Illuminate\Support\Facades\App;

/**
 * @author      Iqbal Maulana <iq.bluejack@gmail.com>
 * @created     6/11/15
 */
abstract class Repository implements RepositoryInterface {

    /**
     * Singleton instance
     *
     * @var static
     */
    private static $_instance;

    /**
     * @var Entity
     */
    private $_model;

    /**
     * Filtering model class
     *
     * @var string
     */
    protected $modelClass;

    /**
     * Filtering data with related keys
     *
     * @var array
     */
    protected $related = [];

    /**
     * Get repository model
     *
     * @return Entity
     *
     * @author Iqbal Maulana <iq.bluejack@gmail.com>
     */
    protected function model() {

        if ($this->_model === null) {

            if (!$this->modelClass) {

                throw new \RuntimeException(
                    sprintf('There are not model class defined on repository "%s".', get_called_class())
                );
            }

            $this->_model = App::make($this->modelClass);
        }

        $model = $this->_model;

        foreach ($this->related as $field => $value) {

            $model = $model->where($field, '=', $value);
        }

        return $model;
    }

    /**
     * Initialize instance and bind relation if exists
     *
     * @param array $related
     */
    final public function __construct(array $related = null) {

        if ($related !== null) {

            $this->related = $related;
        }
    }

    /**
     * Singleton factory
     *
     * @param array|null $related
     *
     * @return Repository
     *
     * @author Iqbal Maulana <iq.bluejack@gmail.com>
     */
    public static function make(array $related = null) {

        $class = static::class;

        if (!isset(self::$_instance[ $class ])) {

            self::$_instance[ $class ] = new static($related);
        }

        return self::$_instance[ $class ];
    }

    /**
     * @param string $id
     *
     * @return Entity
     *
     * @author Iqbal Maulana <iq.bluejack@gmail.com>
     */
    public function findById($id) {

        return $this->model()->find($id);
    }

    /**
     * @param array $criteria
     *
     * @return Collection
     *
     * @author Iqbal Maulana <iq.bluejack@gmail.com>
     */
    public function find(array $criteria) {

        $model = $this->model();

        foreach ($criteria as $field => $value) {

            $parts    = array_filter(explode(' ', $field));
            $operator = count($parts) == 2 ? $parts[1] : '=';

            $model = $model->where($parts[0], $operator, $value);
        }

        return $model->get();
    }

    /**
     * @return Collection
     *
     * @author Iqbal Maulana <iq.bluejack@gmail.com>
     */
    public function findAll() {

        return $this->model()->get();
    }
}