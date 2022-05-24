<?php

namespace App\Models;

use PDO;

use \Core\View;

class ExpenseModel extends BalanceModel
{
	

	



	
	
	
	public function save_expense()
    {
		
			$this->validate();
			
			if (empty($this->errors)){
			 
            $sql = 'INSERT INTO expenses (user_id, expense_category_assigned_to_user_id, payment_method_assigned_to_user_id, amount,date_of_expense,expense_comment)
                    VALUES (:user_id, :expense_category_assigned_to_user_id, :payment_method_assigned_to_user_id, :amount,:date_of_expense,:expense_comment)';

            $db = static::getDB();
            $stmt = $db->prepare($sql);
			
			$expense_category_assigned_to_user_id=balanceModel::get_user_category_id('expenses_category_assigned_to_users', $this->category);
			$payment_method_assigned_to_user_id=balanceModel::get_user_category_id('payment_methods_assigned_to_users', $this->payment_method);
			

            $stmt->bindValue(':user_id', $_SESSION['user_id'], PDO::PARAM_INT);
            $stmt->bindValue(':expense_category_assigned_to_user_id', $expense_category_assigned_to_user_id, PDO::PARAM_INT);
            $stmt->bindValue(':payment_method_assigned_to_user_id', $payment_method_assigned_to_user_id, PDO::PARAM_INT);
            $stmt->bindValue(':amount', $this->amount, PDO::PARAM_STR);
            $stmt->bindValue(':date_of_expense', $this->date, PDO::PARAM_STR);
            $stmt->bindValue(':expense_comment', $this->expense_comment, PDO::PARAM_STR);
			

            return $stmt->execute();
			}
			else{
				$this->errors[] = 'sql error ';
			return false;
			}
	}
	}
			
			
	
        
	
	
	
