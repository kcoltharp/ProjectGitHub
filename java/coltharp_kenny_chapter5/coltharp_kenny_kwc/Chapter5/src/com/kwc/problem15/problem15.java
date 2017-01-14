package com.kwc.problem15;

import java.util.Random;
import javax.swing.JOptionPane;

/**
 *
 * @author		Kenny Coltharp
 * @version		1.0
 *    Date:		June 5, 2015
 *    Description:	This application will create a random number between 0 & 150
 *			for each iteration of the 100 loops. During the loops it will count
 *			how many of the 100 iterations the random number was an even
 *			number. After the last iteration, it will display how many numbers
 *			were even.
 *
 */
public class problem15 {

	//begin method main, this is where the code begins running.
	public static void main(String[] args) {
		//variable to count the number of even numbers
		int evenNumber = 0;
		//instantiate new random number generator called rand
		Random rand = new Random();

		//for loop to loop 100 times
		for(int x = 0; x <= 100; x++){
			//if statment calls method isEven() to determine if number is even.
			//if it is, increase number of even numbers by 1, if not continue loop.
			if(isEven(rand.nextInt(150))){
				evenNumber++;
			}//end if statement
		}//end for loop
		//display the amount of even numbers
		JOptionPane.showMessageDialog(null, "The amount of even numbers was: " + evenNumber);
	}//end main method()

	/**
	 *
	 * @param z integer
	 * @return boolean
	 *
	 * This method will take an integer as an parameter, then determine if that integer is
	 * an even number. If it is, this method will return true, otherwise it will return false.
	 */
	public static boolean isEven(int z){
		//initialize variable to false
		boolean even = false;
		//if number is evenly divisible by 2, it is even
		if((z % 2) == 0){
			//set variable to true if it is
			even = true;
		}
		//return the variable true or false.
		return even;
	}//end method isEven()
}//end class problem15()
