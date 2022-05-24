<?php

namespace App\Controllers;

use \Core\View;
use \App\Auth;
use \App\Flash;
use \App\Models\BalanceModel;
use \App\Models\expenseModel;
use \App\Models\incomeModel;

class Balance extends Authenticated 
{


	public static function render_data($date, $title)
	{
		
		$expense_sum=BalanceModel::findOverallExpenseSum($date['start date'],$date['end date']);
		$income_sum=BalanceModel::findOverallIncomeSum($date['start date'],$date['end date']);
		$balance=$income_sum-$expense_sum;
		$income_sums=BalanceModel::findIncomeSums($date['start date'],$date['end date']);
		
		$alert_class="alert alert-info";
		$alert_info="Your balance equals zero";
		if($balance>0){
			$alert_class="alert alert-success";
			$alert_info="Yours incomes are bigger than expenses. Success!";
		}
		if($balance<0){
			$alert_class="alert alert-danger";
			$alert_info="Warrning! Your expenses are bigger than incomes.";
		}
		
		View::renderTemplate('Balance/Balance.html',[
		'expenses'=>BalanceModel::findExpense($date['start date'],$date['end date']),
		'incomes'=>BalanceModel::findIncome($date['start date'],$date['end date']),
		'expense_sums'=>BalanceModel::findExpensesSums($date['start date'],$date['end date']),
		'income_sums'=>$income_sums,
		'income_sum'=>$income_sum,
		'expense_sum'=>$expense_sum,
		'balance'=>$balance,
		'dropbox'=>true,
		'alert_class'=>$alert_class,
		'alert_info'=>$alert_info,
		'title'=>$title
		
		]);	
		
	}


	public function thisMonthAction()
	{
		balance::render_data(balance::this_month(), 'This month');
		//var_dump(BalanceModel::findIncomeSums('2020-01-01','2022-12-12'));

		
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
		
		
        View::renderTemplate('Balance/Expense.html',[
			'categorys'=>BalanceModel::getCategorys("expenses_category_assigned_to_users"),
			'payment_methods'=>BalanceModel::getCategorys('payment_methods_assigned_to_users'),
			'time'=>date("Y-m-d"),
		]);
		
		
	
		
    }
	
	
	public function incomeAction()
    {
        View::renderTemplate('Balance/Income.html',[
			'categorys'=>BalanceModel::getCategorys('incomes_category_assigned_to_users'),
			'time'=>date("Y-m-d"),
		]);
					
    }
	public function createAction()
    {
		
		$expense = new ExpenseModel($_POST);
		
		if($expense->save_expense()){
			Flash::addMessage('Item added');
			$this->redirect('/Balance/Expense');
			
		}else{
			     View::renderTemplate('/Balance/Expense.html', [
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
			$this->redirect('/Balance/Income');
			
		}else{
			     View::renderTemplate('/Balance/Income.html', [
                'income' => $income,			
				'time'=>date("Y-m-d"),
				]);
		}
		
    }
	   
  public static function  getDoubleCalender()
  {
	 
			//$date=$_POST['start_date'];
			
			//$date=explode("/",$date);
			
			$array = array(
			"start date" => $_POST['start_date'],
			"end date" => $_POST['end_date'],
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