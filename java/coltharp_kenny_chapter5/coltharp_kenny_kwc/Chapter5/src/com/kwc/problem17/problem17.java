package com.kwc.problem17;

import java.awt.HeadlessException;
import java.util.Random;
import javax.swing.JOptionPane;

/**
 *
 * @author		Kenny Coltharp
 * @version		1.0
 *    Date:		June 5, 2015
 *    Description:	This application will ask the user to choose Rock, Paper, or Scissors.
 *			Once the user makes a choice, it is compared to the choice the PC made
 *			and determine a winner based on:
 *			USER	vs.	PC		WINNER
 *			*******************************************
 *			Rock	 vs.	Scissors	Rock
 *			Paper	 vs.	Rock		Paper
 *			Scissors   vs.	Paper		Scissors
 *
 *			Once a winner has been determined, it is displayed to the user.
 *
 */
public class problem17 {
	//Constants used to equate numeric value to the items used.
	private static final int rock = 1;
	private static final int paper = 2;
	private static final int scissors = 3;

/*
 * Begin method main()
 *
 * Code begins to run with this method.
 */
	public static void main(String[] args) {
		//integer variables used for user and computer choices
		int userChoice;
		int computerChoice;
		//string used to show the winner
		String gameWinner;
		//instantiate new random number generator called rand
		Random rand = new Random();

		//begin do..while loop
		do{
			//calculate computers choice based on random number
			computerChoice = (rand.nextInt(2) + 1);
			//call method getUsersChoice to determine the user's choice
			userChoice = getUsersChoice();
			//begin while loop if the user and computer choose the same item
			while(computerChoice == userChoice){
				//begin try...catch to catch the exception thrown by JOptionPane
				try{
					//display a confimation to user that both choices were the same and will need
					//to choose again.
					JOptionPane.showConfirmDialog(null, "Your choice and the computer's choice matched, try again!");
				}catch(HeadlessException e){
					//catches any headless exception thrown by the showConfirmDialog() method
					System.out.println(e.getMessage());
				}
				//calculate computers choice based on random number
				computerChoice = (rand.nextInt(2) + 1);
				//call method getUsersChoice to determine the user's choice
				userChoice = getUsersChoice();
			}
		}while(computerChoice == userChoice);//if user and computer choose same item, repeat loop, otherwise continue

		//call method determmineWinner to determine the game's winner.
		gameWinner = determineWinner(userChoice, computerChoice);
		//begin try...catch to catch the exception thrown by JOptionPane
		try{
			//display a confimation to user that both choices were the same and will need
			//to choose again.
			JOptionPane.showConfirmDialog(null, gameWinner);
		}catch(HeadlessException e){
			//catches any headless exception thrown by the showConfirmDialog() method
			System.out.println(e.getMessage());
		}//display the game winner
	}//end method main


	/**
	 * @return integer
	 *
	 * This method will get the user's choice of Rock, Paper, or Scissors
	 * and return the integer equivalent.
	 */
	public static int getUsersChoice(){
		//local variable used for user's choice
		String usersChoice = null;
		//do..while loop to get and validate user's choice
		do {
			//Display a dialog box and get user's input. Then convert it to lowercase for
			//comparison.
			usersChoice = JOptionPane.showInputDialog("Enter your choice: Rock, Paper, or Scissors");
			usersChoice = usersChoice.toLowerCase();
			if((usersChoice.equals("rock")) | (usersChoice.equals("paper")) | (usersChoice.equals("scissors"))){
				//begin switch
				//match the user's choice with Rock, Paper, or Scissors. If it is none of them, display an error, enter
				//a do...while loop until the choice matches one of them.
				switch (usersChoice) {
					case "rock":
						return rock;
					case "paper":
						return  paper;
					case "scissors":
						return scissors;
				}//end switch
			}else{
				//display an error message if user's choice does not match rock, paper or scissors
				JOptionPane.showConfirmDialog(null, "You did not choose one of the listed choices: Rock, Paper, Scissors!");
			}//end if...else
		}while((!usersChoice.equals("rock")) | (!usersChoice.equals("paper")) | (!usersChoice.equals("scissors")));
		//end do..while loop
		return 0;//return 0 as default like a fail safe.
	}//end method getUsersChoice()

	/**
	 * @param user = integer value of user's choice
	 * @param computer = integer value of computer's choice
	 * @return String
	 *
	 * This method will take the two arguments and determine the game winner,
	 * then return string with either computer or user as the game winner.
	 */
	public static String determineWinner(int user, int computer){
		//Initalize local variable for the winner
		String winner = "";

		//if statement to test for all variations of computer as the winner
		//else if statement to test for all variations of user as the winner
		if(((user == 1) & (computer == 2)) | ((user == 2) & (computer == 1)) | ((user == 3) & (computer == 1))){
			//assign Computer to variable winner
			winner = "Computer wins! Better luck next time.";
		}else if((((user == 2) & (computer == 3)) | ((user == 3) & (computer == 2))) | (user == 1) & ((computer == 2) | (computer == 3))){
			//assign the string to the variable winner
			winner = "Congradulations, You have won!";
		}//end if..else if
		//return the winner string variable
		return winner;
	}//end method determineWinner
}//end class problem17()