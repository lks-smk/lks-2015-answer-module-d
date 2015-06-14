<?php
/*
 * This file is part of the test-project package.
 *
 * (c) Eduostia Corporation <http://eduostia.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace App\Entities;

use App\Repositories\Repository;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Validator;

/**
 * @author      Iqbal Maulana <iq.bluejack@gmail.com>
 * @created     6/11/15
 */
abstract class Entity extends Model {

    /**
     * Entity validation
     *
     * @var array
     */
    protected $rules = [];

    /**
     * Column mapping
     *
     * @var array
     */
    protected $maps = [];

    /**
     * Eager loading relationship
     *
     * @var array
     */
    protected $eagerLoads = [];

    /**
     * Disable timestamp on database table
     *
     * @var boolean
     */
    public $timestamps = false;

    /**
     * @param array $data
     *
     * @return array
     *
     * @author Iqbal Maulana <iq.bluejack@gmail.com>\
     */
    protected function hydrateToOriginal(array $data) {

        $mapped = [];

        foreach ($data as $field => $value) {

            if (isset($this->maps[ $field ])) {

                $field = $this->maps[ $field ];

                if (in_array($field, $this->getGuarded())) {

                    continue;
                }

                $mapped[ $field ] = $value;
            }

            $mapped[ $field ] = $value;
        }

        return $mapped;
    }

    /**
     * Lazy loading belong to relation.
     *
     * @param string      $class
     * @param string      $field
     * @param string      $from
     * @param string|null $to
     *
     * @return Model
     *
     * @author Iqbal Maulana <iq.bluejack@gmail.com>
     */
    protected function lazyBelongTo($class, $field, $from, $to = null) {

        $to = $to ?: $from;

        if (!isset($this->relations[ $field ])) {

            $relation = $this->belongsTo($class, $from, $to);

            $this->relations[ $field ] = $relation->getResults();
        }

        return $this->relations[ $field ];
    }

    /**
     * Lazy loading has many relationship
     *
     * @param string $class
     * @param string $field
     *
     * @return Repository
     *
     * @author Iqbal Maulana <iq.bluejack@gmail.com>
     */
    protected function lazyHasMany($class, $field) {

        if (!isset($this->relations[ $field ])) {

            $this->relations[ $field ] = $class::make([$field => $this->attributes[ $field ]]);
        }

        return $this->relations[ $field ];
    }

    /**
     * Add custom mapping on getter
     *
     * @param string $key
     *
     * @return mixed
     *
     * @author Iqbal Maulana <iq.bluejack@gmail.com>
     */
    public function __get($key) {

        if (isset($this->maps[ $key ])) {

            $key = $this->maps[ $key ];
        }

        return parent::__get($key);
    }

    /**
     * Add custom mapping on setter
     *
     * @param string $key
     * @param mixed  $value
     *
     * @author Iqbal Maulana <iq.bluejack@gmail.com>
     */
    public function __set($key, $value) {

        if (isset($this->maps[ $key ])) {

            $key = $this->maps[ $key ];
        }

        parent::__set($key, $value);
    }

    /**
     * @param array $attributes
     *
     * @author Iqbal Maulana <iq.bluejack@gmail.com>
     */
    public function validate(array $attributes) {

        $validator = Validator::make($attributes, $this->rules);

        if ($validator->fails()) {

            EntityException::errorValidate($validator->errors()->all());
        }
    }

    /**
     * @param array $attributes
     *
     * @return $this
     *
     * @author Iqbal Maulana <iq.bluejack@gmail.com>
     */
    public function fill(array $attributes) {

        $attributes = $this->hydrateToOriginal($attributes);

        return parent::fill($attributes);
    }

    /**
     * @param array $options
     *
     * @return bool
     *
     * @author Iqbal Maulana <iq.bluejack@gmail.com>
     */
    public function save(array $options = []) {

        $this->validate($this->attributes);

        return parent::save($options);
    }

    /**
     * @param array $attributes
     *
     * @return bool|int
     *
     * @author Iqbal Maulana <iq.bluejack@gmail.com>
     */
    public function update(array $attributes = []) {

        $attributes = $this->hydrateToOriginal($attributes);

        return parent::update($attributes);
    }

    /**
     * Serialize model to array
     *
     * @return array
     *
     * @author Iqbal Maulana <iq.bluejack@gmail.com>
     */
    public function toArray() {

        $attributes = [];
        $maps       = array_flip($this->maps);

        //Trigger relationship
        foreach ($this->eagerLoads as $method) {

            $this->{$method}();
        }

        foreach (parent::toArray() as $field => $value) {

            if (isset($maps[ $field ])) {

                $field = $maps[ $field ];
            }

            $attributes[ $field ] = $value;
        }

        return $attributes;
    }
}