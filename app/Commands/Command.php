<?php namespace App\Commands;

use Illuminate\Support\Facades\Validator;

abstract class Command {

    /**
     * Message rules
     *
     * @var array
     */
    protected $rules = [];

    /**
     * Validate command
     *
     * @author Iqbal Maulana <iq.bluejack@gmail.com>
     */
    protected function validate() {

        $validator = Validator::make($this->serialize(), $this->rules);

        if ($validator->fails()) {

            throw new \InvalidArgumentException(implode(' ', $validator->errors()->all()));
        }
    }

    /**
     * Serialize command
     *
     * @return array
     *
     * @author Iqbal Maulana <iq.bluejack@gmail.com>
     */
    public abstract function serialize();

}
