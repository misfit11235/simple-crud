<?php
class User extends Model {
    protected $table = "users";
    public function __construct() {
        parent::__construct();
    }
    public function getTable() {
        return $this->table;
    }
}