<?php
    class deletes extends Dbh{
        public function delete_purchase($id){
            $delete = $this->connectdb()->prepare("DELETE FROM purchases WHERE purchase_id =:purchase_id");
            $delete->bindValue('purchase_id', $id);
            $delete->execute();
        }
    }

?>