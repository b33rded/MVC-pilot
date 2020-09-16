<?php
namespace Core;

class Model {
    protected $db;
    protected $table;
    protected $modelName;
    protected $softDelete = false;
    protected array $columnNames = [];
    public $id;

    public function __construct($table){
        $this->db = DB::getInstance();
        $this->table = $table;
        $this->modelName = str_replace(' ','',ucwords(str_replace('_',' ',$this->table)));
    }

    public function get_columns() {
        return $this->db->get_columns($this->table);
    }

    public function save($params) {
        $fields = $params;
        //update or insert?
        if(property_exists($this, 'id') && $this->id != '') {
            return $this->update($this->id, $fields);
        } else {
            return $this->insert($fields);
        }
    }

    public function insert($fields) {
        if(empty($fields)) return false;
        return $this->db->insert($this->table, $fields);
    }

    public function update($id, $fields) {
        if(empty($fiels) or $id == '') return false;
        return $this->db->update($this->table, $id, $fields);
    }

    public function delete($id = '') {
        if($id == '' && $this->id == '') return false;
        $id = ($id == '')? $this->id : $id;
        if($this->softDelete) {
            return $this->update($id, ['deleted' => 1]);
        }
        return $this->db->delete($this->table, $id);
    }

    public function query($sql, $bind = []) {
        return $this->db->query($sql, $bind);
    }

    public function assign($params) {
        if(!empty($params)) {
            foreach($params as $key=>$value) {
                if(in_array($key, $this->columnNames)) {
                    $this->$key = sanitize($value);
                }
            }
            return true;
        }
        return false;
    }
}
