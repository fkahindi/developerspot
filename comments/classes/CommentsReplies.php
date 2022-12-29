<?php
class CommentsReplies
{

  public function __construct(
    PDO $pdo,
    string $table,
    string $keyfield ='',
    string $keyfield2=''
  ){
      $this->pdo = $pdo;
      $this->table = $table;
      $this->keyfield = $keyfield;
      $this->keyfield2 = $keyfield2;
  }

  private function query( $sql, $parameters=[]){
    $query = $this->pdo->prepare($sql);
    $query->execute($parameters);
    return $query;
  }

  public function countAllRecords($value='')
  {
    $sql = "SELECT COUNT(*) FROM `".$this->table."`
    WHERE `".$this->keyfield."`= :value";

    $parameters = [':value' => $value];

    $total = $this->query($sql, $parameters);

    return $total->fetchColumn();
  }

  public function countPublishedRecords($value1, $value2)
  {
    $sql ="SELECT COUNT(*) FROM `".$this->table."`
    WHERE `".$this->keyfield."`=:value1 AND `".$this->keyfield2."`= :value2";

    $parameters = [':value1'=>$value1, ':value2'=>$value2];

    $total = $this->query($sql, $parameters);

    return $total->fetchColumn();
  }

  public function selectSingleRecord($value)
  {
    $sql = "SELECT * FROM `".$this->table."`
    WHERE `".$this->keyfield."`=:value";

    $parameters =[':value'=>$value];

    $query = $this->query($sql, $parameters);
    return $query->fetch();
  }

  public function getAllRecords($value,$limit='')
  {
    $sql = "SELECT * FROM `".$this->table."`
    WHERE `".$this->keyfield."`=:value".$limit;

    $parameters =[':value'=>$value];

    $query = $this->query($sql, $parameters);

    return $query;
  }
  public function getAllPublishedRecords($value1,$value2,$sort_by='',$limit='')
  {
    $sql ="SELECT * FROM `".$this->table."`
    WHERE `".$this->keyfield."`=:value1 AND `".$this->keyfield2."`=:value2".$sort_by.$limit;

    $parameters =[':value1'=>$value1,':value2'=>$value2];

    $query = $this->query($sql, $parameters);

    return $query;
  }

  public function insertRecord($fields)
  {
    $query = 'INSERT INTO `'.$this->table .'`(';

    foreach($fields as $key=>$value){
      $query .= '`'.$key.'`,';
    }

    $query = rtrim($query, ',');

    $query .= ') VALUES (';

    foreach ($fields as $key=>$value){
      $query .= ':'.$key. ',';
    }
    $query = rtrim($query, ',');
    $query .= ')';

    $this->query($query, $fields);
	}

  public function updateRecords($fields,$keyfield)
  {
		$query ='UPDATE `'.$this->table. '` SET ';

		foreach($fields as $key=>$value){
			$query .= '`'.$key .'` = :'.$key.',';
		}
		$query = rtrim($query, ',');

		$query .= ' WHERE `'.$this->keyfield .'`= :keyfield';

		$fields [':keyfield'] = $keyfield;

		$this->query($query, $fields);
	}

  public function deleteRecords($value)
  {

		$sql = 'DELETE FROM `'.$this->table .'` WHERE `'.$this->keyfield .'` = :value';
		$parameters = [':value' => $value];

		$this->query($sql, $parameters);
	}

  public function toggleRecord($value1,$value2)
  {

    $sql ='UPDATE `'.$this->table. '` SET `'.$this->keyfield2.'`=:value2

     WHERE `'.$this->keyfield .'`= :value1';

    $parameters = [':value1'=>$value1,':value2'=>$value2];

    $this->query($sql, $parameters);
  }
}