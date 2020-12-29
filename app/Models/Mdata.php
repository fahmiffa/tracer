<?php

namespace App\Models;

use CodeIgniter\Database\Query;
use CodeIgniter\Model;

class Mdata extends Model
{

  function __construct()
  {
    $this->db = \Config\Database::connect();
  }

  public function finds($data, $table, $or)
  {
    $builder = $this->db->table($table);
    $builder->like($data);
    $builder->orLike($or);
    $query =  $builder->get();
    return $query->getResult();
  }

  public function safe($data, $table)
  {
    $builder = $this->db->table($table);
    return $builder->insert($data);
  }

  public function join_sum($table, $sama, $where, $sum)
  {
    $builder = $this->db->table($table[0]);
    $builder->select('*');
    if (count($sum) != 0) {
      for ($x = 0; $x < count($sum); $x++) {
        $builder->selectSum($sum[$x]);
      }
    }

    if ($where != 0) {
      $builder->Where($where);
    }
    $gb = count($sama);
    for ($i = 1; $i < $gb; $i++) {
      $builder->join($table[$i], $sama[$i], 'left');
    }
    return $query = $builder->get()->getResult();
  }


  public function inbatch($data, $table)
  {
    $builder = $this->db->table($table);
    return $builder->insertBatch($data);
  }

  public function updateatch($data, $where, $table)
  {
    $builder = $this->db->table($table);
    $builder->Where($where);
    return $builder->updateBatch($data);
  }



  public function view($table, $limit = null)
  {
    $builder = $this->db->table($table);
    if ($limit != null) {
      $builder->limit($limit);
    }
    $query =  $builder->get();
    return $query->getResult();
  }


  public function cc($where, $table)
  {
    $builder = $this->db->table($table);
    $query = $builder->getWhere($where)->getResult();

    if (count($query) < 1) {
      return false;
    } else {
      return $query;
    }
  }


  public function crow($where, $table)
  {
    $builder = $this->db->table($table);
    $query = $builder->getWhere($where)->getResult();

    if (count($query) < 1) {
      return false;
    } else {
      return $builder->getWhere($where)->getRow();
    }
  }


  public function cby($where, $table)
  {
    $builder = $this->db->table($table);
    $query = $builder->getWhere($where)->getResult();
    if (count($query) < 1) {
      return false;
    } else {
      return $builder->getWhere($where)->getLastRow();
    }
  }


  public function cr($where, $table)
  {
    $builder = $this->db->table($table);
    $query = $builder->getWhere($where)->getResultArray();

    if (count($query) < 1) {
      return $query;
    } else {
      return $query;
    }
  }

  public function co($where, $table)
  {
    $builder = $this->db->table($table);
    $builder->orderBy('notif_time', 'DESC');
    $query = $builder->getWhere($where)->getResult();

    if (count($query) < 1) {
      return $query;
    } else {
      return $query;
    }
  }

  public function cv($where, $table)
  {
    $builder = $this->db->table($table);
    if ($where != 0) {
      $builder->Where($where);
    }
    $query =  $builder->get();
    return $query->getResult();
  }

  public function cn($where, $table)
  {
    $builder = $this->db->table($table);
    if ($where != 0) {
      $builder->Where($where);
    }
    return $builder->countAll();
  }

  public function jn($where, $table, $sum)
  {
    $builder = $this->db->table($table);
    if (count($sum) != 0) {
      for ($x = 0; $x < count($sum); $x++) {
        $builder->selectSum($sum[$x]);
      }
    }
    if ($where != 0) {
      $builder->Where($where);
    }
    return $query = $builder->get()->getResult();
  }

  public function dc($where, $table)
  {
    $builder = $this->db->table($table);
    $builder->Where($where);
    $query = $builder->get()->getResult();

    if (count($query) < 1) {
      return false;
    } else {
      return $builder->delete($where);
    }
  }

  //update
  public function ud($where, $table, $data)
  {
    $builder = $this->db->table($table);
    $builder->update($data, $where);
  }

  // delete
  public function dl($where, $table)
  {
    $builder = $this->db->table($table);
    return $builder->delete($where);
  }


  // join
  public function join($table, $sama, $where)
  {
    $builder = $this->db->table($table[0]);
    $builder->select('*');
    if ($where != 0) {
      $builder->Where($where);
    }
    $gb = count($sama);
    for ($i = 1; $i < $gb; $i++) {
      $builder->join($table[$i], $sama[$i], 'left');
    }
    return $query = $builder->get()->getResult();
  }

  public function join_right($table, $sama, $where)
  {
    $builder = $this->db->table($table[0]);
    $builder->select('*');
    if ($where != 0) {
      $builder->Where($where);
    }
    $gb = count($sama);
    for ($i = 1; $i < $gb; $i++) {
      $builder->join($table[$i], $sama[$i], 'right');
    }
    return $query = $builder->get()->getResult();
  }

  public function join_left($table, $sama, $where)
  {
    $builder = $this->db->table($table[0]);
    $builder->select('*');
    if ($where != 0) {
      $builder->Where($where);
    }
    $gb = count($sama);
    for ($i = 1; $i < $gb; $i++) {
      $builder->join($table[$i], $sama[$i]);
    }
    return $query = $builder->get()->getResult();
  }


  public function join_row($table, $sama, $where)
  {
    $builder = $this->db->table($table[0]);
    $builder->select('*');
    if ($where != 0) {
      $builder->Where($where);
    }
    $gb = count($sama);
    for ($i = 1; $i < $gb; $i++) {
      $builder->join($table[$i], $sama[$i]);
    }
    return $query = $builder->get()->getRow();
  }


  // join or
  public function join_or($table, $sama, $where, $or)
  {
    $builder = $this->db->table($table[0]);
    $builder->select('*');
    if ($where != 0) {
      $builder->Where($where);
    }
    $builder->orWhere($or);
    $gb = count($sama);
    for ($i = 1; $i < $gb; $i++) {
      $builder->join($table[$i], $sama[$i], 'left');
    }
    return $query = $builder->get()->getResult();
  }


  // join gruup
  public function joingroup($table, $sama, $where, $group)
  {
    $builder = $this->db->table($table[0]);
    $builder->select('*');
    if ($where != 0) {
      $builder->Where($where);
    }
    $gb = count($sama);
    for ($i = 1; $i < $gb; $i++) {
      $builder->join($table[$i], $sama[$i]);
    }

    return $query = $builder->get()->getResult();
  }
}
