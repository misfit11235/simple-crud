<?php
class Address extends Model {
    protected $table = "addresses";
    public function __construct() {
        parent::__construct();
    }
    public function getTable() {
        return $this->table;
    }
}