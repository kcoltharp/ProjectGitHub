package carman_jason_IPO;
//This line will allow the scanner class to be used in this program
import java.util.Scanner;

public class Carman_jason_IPO_main {

	public static void main(String[] args)
	{
		//Declaring my string variables
		String userName;
		//Declaring my integer variables
		int numberOne;
		int numberTwo;
		//Declaring my double variable, this has decimal places
		double finalAnswer;
		//This creates a variable called keyboard, of type scanner.  It allows for input
		Scanner keyboard = new Scanner(System.in);

		//Outputs a prompt for text
		System.out.print("What is your name:  ");
		//Inputs the next line as a string
		userName = keyboard.nextLine();
		
		//Outputs a prompt for number one
		System.out.print("Enter Number one: ");
		//Inputs an integer into the variable
		numberOne = keyboard.nextInt();
		
		//Outputs a prompt for number two
		System.out.print("Enter Number two: ");
		//Inputs an integer into the variable
		numberTwo = keyboard.nextInt();
		
		//Adds the two numbers together
		finalAnswer = numberOne + numberTwo;
		
		//This will output both text and numbers concatenated together
		System.out.println("Your name is: "  + userName + " and your number is " + finalAnswer);
		
		keyboard.close();
		
	}
	
}
