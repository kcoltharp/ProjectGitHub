package account;

// Inputting and outputting floating-point numbers with Account objects.
import java.util.Scanner;

public class AccountTest
{
	// main method begins execution of Java application  

	public static void main(String args[])
	{
		// variable declarations
		double depositAmount, debitAmount;

		Scanner input = new Scanner(System.in);     // create Scanner object
		
		Account myAccount1 = new Account(100.00);   // create Account object
		Account myAccount2 = new Account(-9.53);    // create Account object
		
		// display initial balance of each object
		System.out. printf("account1 balance: $%.2f\n", myAccount1.getBalance());
		System.out.printf("account2 balance: $%.2f\n\n", myAccount2.getBalance());

		// prompt and get deposit amount for account1 and deposit amount
		System.out.print("Enter deposit amount for account1: ");
		depositAmount = input.nextDouble();
		System.out.printf("\nadding %.2f to account1 balance\n\n", depositAmount);
		myAccount1.credit(depositAmount);

		// display balances
		System.out.printf("account1 balance: $%.2f\n", myAccount1.getBalance());
		System.out.printf("account2 balance: $%.2f\n\n", myAccount2.getBalance());

		// prompt and get deposit amount for account2 and deposit amount
		System.out.print("Enter deposit amount for account2: ");
		depositAmount = input.nextDouble();
		System.out.printf("\nadding %.2f to account2 balance\n\n",  depositAmount);
		myAccount2.credit(depositAmount);

		// display balances
		System.out. printf("account1 balance: $%.2f\n", myAccount1.getBalance());
		System.out.printf("account2 balance: $%.2f\n", myAccount2.getBalance());

		System.out.printf("Please enter which account you wish to work with\nAccount 1: 1\nAccount "
			   + "2: 2\nNumber :  ");
		int i = input.nextInt();

		switch (i)
		{
			case 1:
				System.out.printf("\nYou are working with Account 1.\nPlease select from the "
					   + "following actions\n\nBalance Press 1\nDeposit Press 2\nWithdrawal "
					   + "Press 3\nNumber :  ");
				int j = input.nextInt();
				switch (j)
				{
					case 1:
						System.out.printf("Account 1 balance is: $%.2f\n",  myAccount1.getBalance());
						break;
					case 2:
						System.out.print( "Enter deposit amount for account1: ");
						depositAmount = input.nextDouble();
						System.out.printf("\nadding %.2f to account2 balance\n\n", depositAmount);
						myAccount2.credit(depositAmount);
						System.out.printf("Account 1 new balance is: $%.2f\n", myAccount1.getBalance());
						break;
					case 3:
						System.out.print("\nEnter amount you would like to witdraw from Account1: ");	
						debitAmount = input.nextDouble();
						while (debitAmount < 1.00)
						{
							System.out.printf("\n\nInvalid withdrawal amount, please "
								   + "enter a valid amount to withdraw from Account1:  ");
							debitAmount = input.nextDouble();

							if (debitAmount >= 1.00)
							{
								myAccount1.debit(debitAmount);
								System.out.printf("\n\nThe new balance for Account1 "
									   + "is: $%.2f\n\n", myAccount1.getBalance());
							}//end if stmt
						}//end while loop
						break;
				}//end j swittch
			case 2:
				System.out.printf("\nYou are working with Account 1.\nPlease select from the "
					   + "following actions\n\nBalance Press 1\nDeposit Press 2\nWithdrawal "
					   + "Press 3\nNumber :  ");
				int h = input.nextInt();
				switch (h)
				{
					case 1:
						System.out.printf("Account 2 balance is: $%.2f\n",  myAccount2.getBalance());
						break;
					case 2:
						System.out.print( "Enter deposit amount for account2: ");
						depositAmount = input.nextDouble();
						System.out.printf("\nadding %.2f to account2 balance\n\n", depositAmount);
						myAccount2.credit(depositAmount);
						System.out.printf("Account 2 new balance is: $%.2f\n", myAccount2.getBalance());
						break;
					case 3:
						System.out.print("\nEnter amount you would like to witdraw from Account2: ");	
						debitAmount = input.nextDouble();
						while (debitAmount < 1.00)
						{
							System.out.printf("\n\nInvalid withdrawal amount, please "
								   + "enter a valid amount to withdraw from Account2:  ");
							debitAmount = input.nextDouble();

							if (debitAmount >= 1.00)
							{
								myAccount2.debit(debitAmount);
								System.out.printf("\n\nThe new balance for Account2 "
									   + "is: $%.2f\n\n", myAccount2.getBalance());
							}//end if stmt
						}//end while loop
						break;
				}

			case 3:
				break;

			case 4:
				break;
		}
	} // end main
} // end class AccountTest

