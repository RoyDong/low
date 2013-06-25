<?php

namespace model;


class Base
{
	/**
	 * mysql database connection
	 */
	private $pdo;

	/**
	 * data table used as table table or cache key prefix
	 * @var string
	 */
	protected $table;

    protected $entities = [];

    /**
	 * get mysql connection
	 * @return mysql db connection
	 */
	protected function pdo()
	{
		if(!$this->pdo)
		{
            $db = \Yaf\Registry::get('db');
			$this->pdo = new \PDO($db->get('dsn'), 
                    $db->get('user'), $db->get('passwd'));
            //$this->pdo->setAttribute(\PDO::ATTR_EMULATE_PREPARES, 0);
		}

		return $this->pdo;
	}

    protected function setEntity($key, $entity)
    {
        $this->entities[$key] = $entity;
    }

    protected function getEntity($key)
    {
        return isset($this->entities[$key]) ? $this->entities[$key] : null;
    }

    /**
	 * insert data
	 * @param array $data
	 * @return int 
	 */
	public function insert($data)
	{
		$columns = $values = array();

		foreach( $data as $column => $value )
		{
			$columns[] = $column;
			$values[] = $value;
		}

        $sql = 'insert into `'.$this->table
                .'` (`'.implode('`,`', $columns).'`) values ("'
                . implode('","', $values ).'")';

        $this->pdo()->exec($sql);

        return $this->pdo->lastInsertId();
	}

	/**
	 * update data 
	 * @param array $data
	 * @param string $where
	 */
	public function update($data, $where)
	{
		return $this->pdo()->exec($this->getUpdateSql($data, $where));
	}

    protected function getUpdateSql($data, $where)
    {
        $sql = 'UPDATE `'.$this->table.'` SET ';

		foreach($data as $column => $value)
			$sql .= '`'.$column.'`="'.$value.'",';

        $sql[strlen($sql) - 1] = ' ';

        return $sql.'WHERE '.$where;
    }

	protected function delete( $where , $limit = '0,1' )
	{
		return $this->pdo()->exec(
                'delete * from `'.$this->table.'` where '.$where.' '.$limit );
	}

    public function fetch($criteria)
    {
        $sql = 'select * from `'.$this->table.'` where 1=1';
        foreach($criteria as $key => $value) $sql .= " and `$key`='$value'";
        $sql .= ' limit 0,2';

        return $this->pdo()->query($sql)->fetch(\PDO::FETCH_ASSOC);
    }

    public function fetchAll($criteria, $order = null, $limit = 0, $offset = 0)
    {
        $sql = 'select * from `'.$this->table.'` where 1=1';

        if($criteria)
            foreach($criteria as $key => $value) $sql .= " and `$key`='$value'";

        if(is_array($order))
        {
            list($column, $value) = each($order);
            $sql .= " order by $column $value";
        }

        if($limit) $sql .= ' limit '.$offset.', '.$limit;

        return $this->pdo()->query($sql)->fetchAll(\PDO::FETCH_ASSOC);
    }

	public function count($where = '1=1')
	{
        $sql = 'select count(*) c from `'.$this->table.'` where '.$where;

		return $this->pdo()->query($sql)->fetch(\PDO::FETCH_ASSOC)['c'];
	}
}
