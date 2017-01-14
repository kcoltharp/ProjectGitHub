/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package account;

/**
 *
 * @author Kenny
 */
public class Account
{

	private double _balance; // instance variable that stores the balance

	// constructor  
	public Account(double initialBalance)
	{
      // validate that initialBalance is greater than 0.0; 
		// if it is not, balance is initialized to the default value 0.0
		if (initialBalance > 0.0)
		{
			_balance = initialBalance;
		}
	} // end Account constructor

	// credit (add) an amount to the account
	public void credit(double amount)
	{
		_balance = _balance + amount; // add amount to balance 
	} // end method credit

	public void debit(double amount)
	{
		_balance = _balance - amount;
	}

	// return the account balance
	public double getBalance()
	{
		return _balance; // gives the value of balance to the calling method
	} // end method getBalance

} // end class Account
