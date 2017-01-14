package com.kwc.problem7;

import java.util.Arrays;
import java.util.Scanner;

/**
 *	
 * 
 *	Date: 		May 18, 2015
 *	Description: 	This application will get 3 names from the user. Then the
 * 			application will sort the names in alphabetical order. Then
 * 			display the names in that order.
 *	@version	1.0
 *	@author	Kenny Coltharp
 */
public class Chapter3_problem7 {

	//This is the main method where the application will begin running the code.
	public static void main(String[] args) {
		//declare a string array to hold the 3 names the user will input
		String[] name = new String[3];		
		
		//instantiate new scanner to get input from user
		Scanner input = new Scanner(System.in);
		
		//This for loop will get the input from the user and put into the array.
		for(int x = 0; x < name.length; x++) {
			int z = x + 1;
			System.out.println("Please enter name number " + z + " to sort: ");
			name[x] = input.next();
		}//end for loop
		//close the scanner resource
		input.close();
		
		//sort the array alphabetically
		Arrays.sort(name);
		
		System.out.println("The names have put into alphabetical order.\n"
							+ "\tIn order they are: ");
		
		//print the names from the array in the new alphabetical order.
		for(String printName : name) {
			System.out.println("\t" + printName);
		}//end for loop
	}//end method main
}//end class Coltharp_kenny
