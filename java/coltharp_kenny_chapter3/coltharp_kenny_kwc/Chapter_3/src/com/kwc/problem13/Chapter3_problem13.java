package com.kwc.problem13;

import java.util.NoSuchElementException;
import java.util.Scanner;
/**
 * 
 * @author		Kenny Coltharp
 * @version		1.0
 *    Date:		May 26, 2015
 *    Description:	This application will ask the user for the Internet package they
 *			purchased and the amount of Internet hours on their bill. Then
 *			it will calculate the mount of hours over the package allowance
 *			and return the package they purchased, the amount of hours
 *			the package allows, the Internet hours they used on their bill,
 *			and the total bill.
 */
public class Chapter3_problem13 {

	/*
	  * These are constants used to return the package name,
	  *  package cost, hours allowed for each package, and
	  *  the amount per hour charged above the package allowance.
	  */
	private static final String package_A = "Internet Package A";
	private static  final double packageA = 9.95;//for 1st 10 hours, then 2.00 per hour
	private static  final double allowedHoursA = 10;
	private static  final double overageHoursA = 2.00;
	private static  final String package_B = "Internet Package B";
	private static  final double packageB = 13.95;//for 1st 20 hours, then 1.00 per hour
	private static  final double allowedHoursB = 20;
	private static  final double overageHoursB = 1.00;
	private static  final String package_C = "Internet Package C";
	private static  final double packageC = 19.95;//for unlimited access
	private static  final double allowedHoursC = 0;
	
	//constructor for this class object
	public Chapter3_problem13() {
	}
	
	public static void main(String[] args) {
		//varibles declared and initialized.
		String packagePurchased = null;
		double additionalHours = 0.00;
		double internetHours = 0.00;
		double totalBill = 0.00;
		String output = "The package you purchased is  \t\t\t%1s.\r\nThis package allows\t\t\t\t%2.2f hours\r\n"
			   + "On this bill your incurred a total amount of  \t%3.2f hours\r\nYou went over\t\t\t\t\t%4.2f hours\r\n"
			   + "_______________________________________________________________\r\n"
			   + "This brings your total bill to \t\t\t$%5$.2f\r\n";
		
		//create a scanner object to get input from user
		Scanner input = new Scanner(System.in);
		//instantiate a new class object
		Chapter3_problem13 prob13 = new Chapter3_problem13();
		
		//try..catch block to catch the NoSuchElementException 
		//with a finally clause to close the input object
		try{
			//get the package the user purchased and the number of hours
			//on the users bill for Internet services
			packagePurchased = prob13.getPackage();
			internetHours = prob13.getHours();
		}catch(NoSuchElementException e){
			//if an error occurs, print out the error
			System.out.println(e.getMessage());
		}finally{
			//close input object
			input.close();
		}//end try...catch...finally block
		//switch statement to 1) determing package purchased, 2) calculate the additional Internet hours,
		//3) calculate the total bill, and 4) output the data
		switch (packagePurchased) {
			case "A":
				additionalHours = internetHours - allowedHoursA;
				totalBill = packageA + additionalHours;
				System.out.format(output, package_A, allowedHoursA,  internetHours, additionalHours, totalBill);
				break;
			case "B":
				additionalHours = internetHours - allowedHoursB;
				totalBill = packageB + additionalHours;
				System.out.format(output, package_B, allowedHoursB,  internetHours, additionalHours, totalBill);
				break;
			case "C":
				totalBill = packageC;
				output = "The package you purchased is  \t\t\t%1s.\r\nThis package allows\t\t\t\t%s hours\r\n"
					   + "On this bill your incurred a total amount of  \t%3.2f hours\r\nYou went over\t\t\t\t\t%4.2f hours\r\n"
					   + "_______________________________________________________________\r\n"
					   + "This brings your total bill to \t\t\t$%5$.2f\r\n";
				System.out.format(output, package_C, "Unlimited",  internetHours, additionalHours, totalBill);
				break;
		}//end switch block
	}//end method main
	
	/**
	 * 
	 * @return String packagePurchased
	 * @param None
	 * 
	 * This method will get the package the user purchased and validate the package is a correct package
	 *  and then return the package purchased to the main method
	 */
	private String getPackage() {
		//declare and initialize variables
		String packagePurchased = null;
		String strPackage = "You have purchased %1s.\r\nThis package allows 10 Internet hours. "
					   + "After the initial hours, \r\na charge of $%2$.2f per hour is incurred. The total "
					   + "bill will be \r\n$%3$.2f for the monthly package cost plus the amount of hours "
					   + "\r\nover the initial allowance *  $%2$.2f.\r\n";
		//setup scanner to get input from user
		Scanner input = new Scanner(System.in);
		
		//begin do..while loop will ask user for packagePurchased until it is a correct package
		do{
			//get input from user
			System.out.println("\r\nPlease enter the letter of the package you have purchased.\r\n"
				   + "Package \"A\", \"B\", or \"C\":");
			packagePurchased = input.next();
			//convert input to upper case
			packagePurchased = packagePurchased.toUpperCase();
			
			//if..else if..else block to determine which package the user selected
			if(packagePurchased.equals("A")) {
				System.out.printf(strPackage, package_A, overageHoursA, packageA);
				input.close();
				return packagePurchased;
			}else if(packagePurchased.equals("B")) {
				System.out.printf(strPackage, package_B, overageHoursB, packageB);
				input.close();
				return packagePurchased;
			}else if(packagePurchased.equals("C")) {
				System.out.printf(strPackage, package_C, allowedHoursC, packageC);
				input.close();
				return packagePurchased;				
			}else if(packagePurchased.isEmpty()){
				//if user did not enter any data display an error message
				System.out.println("You did not enter anything!");
			}else{
				//if none of the above, display an error message
				System.out.println("\r\nERROR: You did not select a proper package please \r\n"
					   + "try again and select \"A\",\"B\", or \"C\":");
			}//end if...else if...else block
		}while(!packagePurchased.equals("A") || !packagePurchased.equals("B") || 
		            !packagePurchased.equals("C") || packagePurchased.isEmpty() );//end do...while loop
		
		//return the user input and close the input
		input.close();
		return packagePurchased;
	}//end method getPackage()
	
	/** 
	 * @return double hoursCharged
	 * @param None
	 * 
	 * This method will get the amount of hours on the user's bill, verify it is numeric and 
	 * validate that it is above zero, then return the hoursCharged to the main method
	 */
	private double getHours() {
		//declare variable and setup scanner to get input from user
		String hoursCharged;
		Scanner input = new Scanner(System.in);
		//get user input for the number of hours billed
		System.out.println("\r\nEnter the amount of internet hours listed on your bill: ");
		hoursCharged = input.nextLine();
		//convert string to a double
		double billedHours = Double.parseDouble(hoursCharged);
		
		//if the variables do not contain a numeric character and is equal to or above 0 enter loop
		while((containsOnlyNumbers(hoursCharged)) && ((billedHours <= 0))) {
			//get input from user
			System.out.println("\r\nEnter the amount of internet hours listed on your bill: ");
			hoursCharged = input.nextLine();
			//determine if input contains numeric characters
			if(containsOnlyNumbers(hoursCharged)) {
				//if it is numeric, convert string to a double
				billedHours = Double.parseDouble(hoursCharged);
				if(billedHours > 0) {
					//if double is more than 0, close input and return the double variable to main method
					input.close();
					return billedHours;
				}else{
					//if it is not more than 0, display an error
					System.out.println("ERROR: The amount of hours was less than 0 please "
						   + "enter the amount of billed hours above 0.");
				}
			}else{
				//if it was not numeric, display an error
				System.out.println("ERROR: You entered something other than the hours billed in "
					   + "numeric format. EXAMPLE: 6.25");
			}//end if/else block			
		}//end while loop
		//close input and return variable billedHours to main method
		input.close();
		return billedHours;
	}//end method getHours
	
	/** 
	 * @param String str
	 * @return boolean
	 * 
	 * This method takes a string input and tests each character to determine if it is a number. If any
	 * character is not a number it will return false. If all characters are numeric, it will return true.
	 */
	private boolean containsOnlyNumbers(String str) {
		//take the string and test it one character at a time
		for (int i = 0; i < str.length(); i++) {
			//test if character is a number or not 
			if (!Character.isDigit(str.charAt(i)))
				//return false if any characters are non numbers
				return false;
			}
		//return true if all are only numbers
		return true;
	}//end method containsOnlyNumbers	
}//end class Chapter3_problem13
