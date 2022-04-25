<?php

namespace App\Models;

use PDO;

use \Core\View;

class IncomeModel extends BalanceModel
{
	public function save_income()
    {
		
			$this->validate();
			
			if (empty($this->errors)){
			 
            $sql = 'INSERT INTO incomes (user_id, income_category_assigned_to_user_id,  amount,date_of_income,income_comment)
                    VALUES (:user_id, :income_category_assigned_to_user_id,  :amount,:date_of_income,:income_comment)';

            $db = static::getDB();
            $stmt = $db->prepare($sql);
			
			$income_category_assigned_to_user_id=balanceModel::get_user_category_id('incomes_category_assigned_to_users', $this->category);
			
			

            $stmt->bindValue(':user_id', $_SESSION['user_id'], PDO::PARAM_INT);
            $stmt->bindValue(':income_category_assigned_to_user_id', $income_category_assigned_to_user_id, PDO::PARAM_INT);
            
            $stmt->bindValue(':amount', $this->amount, PDO::PARAM_STR);
            $stmt->bindValue(':date_of_income', $this->date, PDO::PARAM_STR);
            $stmt->bindValue(':income_comment', $this->income_comment, PDO::PARAM_STR);
			

            return $stmt->execute();
			}
			return false;
	}

	
	
	
}