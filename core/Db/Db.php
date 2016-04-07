<?php

namespace Db;

class Db extends DBAbstration
{
    protected $args = [];

    protected $name = 'users';

    /**
     * New rows introduse.
     *
     * @param array $args
     */
    public function create($args = ['name' => 'tito46', 'pass' => '123'])
    {
        foreach ($args as $k => $v) {
            $this->args[] = ['key' => $k, 'keyPdo' => ':'.$k, 'value' => $v];
        }

        parent::create();
    }
}
