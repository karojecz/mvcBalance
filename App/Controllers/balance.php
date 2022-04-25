<?php

namespace App\Controllers;

use \Core\View;
use \App\Auth;
use \App\Flash;
use \App\Models\balanceModel;
use \App\Models\ExpenseModel;
use \App\Models\incomeModel;

class Balance extends Authenticated
{
	
	

	public static function render_data($date, $title)
	{
		//balanceModel::testMailer();
		View::renderTemplate('balance/balance.html',[
		'expenses'=>balanceModel::findExpense($date['start date'],$date['end date']),
		'incomes'=>balanceModel::findIncome($date['start date'],$date['end date']),
		'expense_sums'=>balanceModel::findExpensesSums($date['start date'],$date['end date']),
		'income_sums'=>balanceModel::findIncomeSums($date['start date'],$date['end date']),
		'dropbox'=>true,
		'title'=>$title
		
		]);	
		
	}

	public function thisMonthAction()
	{
		balance::render_data(balance::this_month(), 'This month');
		//var_dump(balanceModel::findExpense('2020-01-01','2022-04-29'));
		
	}
	public function lastMonthAction()
	{
		balance::render_data(balance::last_month(), 'Last month');
		
	}
	public function thisYearAction()
	{
		balance::render_data(balance::this_year(), 'This year');
	}
	public function lastYearAction()
	{
		balance::render_data(balance::last_year(), 'Last year');
	}
	
	
	
	public function expenseAction()
    {
		
        View::renderTemplate('balance/expense.html',[
			'categorys'=>balanceModel::getCategorys("expenses_category_assigned_to_users"),
			'payment_methods'=>balanceModel::getCategorys('payment_methods_assigned_to_users'),
			'time'=>date("Y-m-d"),
		]);
		
	
		
    }
	
	
	public function incomeAction()
    {
        View::renderTemplate('balance/income.html',[
			'categorys'=>balanceModel::getCategorys('incomes_category_assigned_to_users'),
			'time'=>date("Y-m-d"),
		]);
					
    }
	public function createAction()
    {
		
		$expense = new ExpenseModel($_POST);
		
		if($expense->save_expense()){
			Flash::addMessage('Item added');
			$this->redirect('/balance/expense');
			
		}else{
			     View::renderTemplate('/balance/expense.html', [
                'expense' => $expense,
				'payment_methods'=>ExpenseModel::getCategorys('payment_methods_assigned_to_users'),
				'time'=>date("Y-m-d"),
				]);
		}
		
    }
	public function createIncomeAction()
    {
		
		$expense = new IncomeModel($_POST);
		
		if($expense->save_income()){
			Flash::addMessage('Item added');
			$this->redirect('/balance/income');
			
		}else{
			     View::renderTemplate('/balance/income.html', [
                'income' => $income,			
				'time'=>date("Y-m-d"),
				]);
		}
		
    }
	   
  public static function  getDoubleCalender()
  {
	 
			$date=$_POST['datefilter'];
			
			$date=explode("/",$date);
			
			$array = array(
			"start date" => $date[0],
			"end date" => $date[1],
			);
		
			return $array;
  }
  public static function get_title()
  {
	  $title=balance::getDoubleCalender();
	  $start_date=strval($title['start date']);
	  $end_date=strval($title['end date']);
	  
	  $title="Balance from ".$start_date." to ".$end_date;
	  return $title;
  }
  
  public function customAction()
  {
	  balance::render_data(balance::getDoubleCalender(), balance::get_title());
	 // var_dump(balance::getDoubleCalender());
  }


  public static function this_month()
  {
	$date['start date'] = date('Y-m-01');
	$date['end date'] = date('Y-m-d');
	  
	  return $date;
  }
  public static function last_month()
  {
	$date['start date'] = date('Y-m-d', strtotime("first day of previous month"));
	$date['end date'] = date('Y-m-d', strtotime("last day of previous month"));
	  
	 return $date;
  }
  public static function this_year()
  {
	$date['start date'] = date('Y-m-d', strtotime("first day of january this year"));
	$date['end date'] = date('Y-m-d', strtotime("last day of this month"));
	  
	 return $date;
  }
  public static function last_year()
  {
	$date['start date'] = date('Y-01-01', strtotime("-1 year"));
	$date['end date'] = date('Y-12-31', strtotime("-1 year"));
	  
	 return $date;
  }
	

}