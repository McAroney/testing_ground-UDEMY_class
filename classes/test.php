<?php
  class Test extends Database{
    public function index(){
      try{
        $this->query('SELECT * FROM tests ORDER BY create_date DESC');
        $i = 0;
        while($rows = $this->resultSet()){
          if($i < count($rows)){
            yield $rows[$i];
            $i++;
          } else {
            return count($rows). ' Tests Listed';
          }
        }
      } catch(Throwable $e){
        echo '<div class="alert alert-danger">'.get_class($e).' on line '.$e->getLine().' of '.$e->getFile().': '.$e->getMessage().'</div>';
      }
    }

    public function add(string $text, string $creator){
      try{
        $this->query('INSERT INTO tests(text, creator) VALUES(:text, :creator)');
        $this->bind(':text', $text);
        $this->bind(':creator', $creator);
        $this->execute();
      }catch(Throwable $e){
        echo '<div class="alert alert-danger">'.get_class($e).' on line '.$e->getLine().' of '.$e->getFile().': '.$e->getMessage().'</div>';
      }

      // Veirfy
      if($this->lastInsertId()){
        // Redirect
        header('Location: index.php');
      }
    }

    public function getSingle(int $id):array{
      try{
        $this->query('SELECT * FROM tests WHERE id = :id');
        $this->bind(':id', $id);
        $row = $this->single();
        return $row;
      }catch(Throwable $e){
        echo '<div class="alert alert-danger">'.get_class($e).' on line '.$e->getLine().' of '.$e->getFile().': '.$e->getMessage().'</div>';
      }
    }

    public function update(int $id, string $text, string $creator){
      try{
        $this->query('UPDATE tests SET text = :text, creator = :creator WHERE id = :id');
        $this->bind(':text', $text);
        $this->bind(':creator', $creator);
        $this->bind(':id', $id);
        $this->execute();
      }catch(Throwable $e){
        echo '<div class="alert alert-danger">'.get_class($e).' on line '.$e->getLine().' of '.$e->getFile().': '.$e->getMessage().'</div>';
      }

      header('Location: index.php');
    }

    public function remove(int $id){
      try{
        $this->query('DELETE FROM tests WHERE id = :id');
        $this->bind(':id', $id);
        $this->execute();
      }catch(Throwable $e){
        echo '<div class="alert alert-danger">'.get_class($e).' on line '.$e->getLine().' of '.$e->getFile().': '.$e->getMessage().'</div>';
      }

      header('Location: index.php');
    }
  }
