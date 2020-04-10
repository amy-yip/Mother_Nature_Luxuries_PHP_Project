<?php

class Item extends Model
{
	var $name;

	public function get()
	{
        $SQL = 'SELECT * FROM Item';
        $stmt = self::$_connection->prepare($SQL);
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_CLASS, 'Item');
        return $stmt->fetchAll();
	}

	public function create()
	{
		$SQL = 'INSERT INTO Item(name) VALUES(:name)';
		$stmt = self::$_connection->prepare($SQL);
		$stmt->execute(['name'=>$this->name]);
		return $stmt->rowCount();
	}

	public function find($item_id)
	{
		$SQL = 'SELECT * FROM Item WHERE item_id = :item_id';
        $stmt = self::$_connection->prepare($SQL);
        $stmt->execute(['item_id'=>$item_id]);
        $stmt->setFetchMode(PDO::FETCH_CLASS, 'Item');
        return $stmt->fetch();
	}

	public function update()
	{
		$SQL = 'UPDATE Item SET name = :name WHERE item_id = :item_id';
		$stmt = self::$_connection->prepare($SQL);
		$stmt->execute(['name'=>$this->name, 'item_id'=>$this->item_id]);
		return $stmt->rowCount();
	}

	public function delete()
	{
		$SQL = 'DELETE FROM Item WHERE item_id = :item_id';
		$stmt = self::$_connection->prepare($SQL);
		$stmt->execute(['item_id'=>$this->item_id]);
		return $stmt->rowCount();
	}


}

?>