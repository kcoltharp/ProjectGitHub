package chapter6.problem14;

import javax.swing.JOptionPane;

/**
 *
 * @author	Kenny Coltharp
 *  Date	July 3, 2015
 *  Version	1.0
 *  Purpose	This class will create 2 die, roll them 10 times. Each
 *		time the dice are cast, one will belong to the computer
 *		the other belongs to the computer, a winner will be
 *		determined by the highest die. Once the dice are cast
 *		10 times, a game winner will be determined by the number
 *		of times each roll was won.
 */
public class Problem14 {

	//Constants for the number of sides for the dice and
	//the maximum number of rolls.
	static final int DIE_SIDES = 6;
	static final int ROLLS = 10;
	
	/**
	 * @param args the command line arguments
	 */
	public static void main(String[] args) {
		int userWins = 0;
		int computerWins = 0;
		int rollTies = 0;
                int continueInt;
		
		//Create a die for each player
		Die userDie = new Die(DIE_SIDES);
		Die computerDie = new Die(DIE_SIDES);
				
		
		do{
                    //Display initial value of the dice
		JOptionPane.showMessageDialog(null, "The initial value of the "
                        + "dice are:\nPlayer: " + userDie.getValue() 
                        + "\nComputer:  " + computerDie.getValue());
                
                    for (int i = 0; i < ROLLS; i++) {	
                            //simulate rolling the dice
                            userDie.roll();
                            computerDie.roll();			

                            //This block of code will determine who won the roll and display the
                            //value of each die
                            if(userDie.getValue() > computerDie.getValue()){
                                    JOptionPane.showMessageDialog(null, "Roll number : " + (i + 1) + "\nPlayer wins this roll!\n" 
                                                                + "Player: " + userDie.getValue() 
                                                                + "\nComputer:  " + computerDie.getValue());
                                    userWins += 1;
                            }else if(computerDie.getValue() > userDie.getValue()){
                                    JOptionPane.showMessageDialog(null, "Roll number : " + (i + 1) + "\nComputer wins this roll!\n" 
                                                                + "Player: " + userDie.getValue() 
                                                                + "\nComputer:  " + computerDie.getValue());
                                    computerWins += 1;
                            }else if(computerDie.getValue() == userDie.getValue()){
                                    JOptionPane.showMessageDialog(null, "Roll number : " + (i + 1) + "\nThere was a tie. No Winner!\n" 
                                                                + "Player: " + userDie.getValue() 
                                                                + "\nComputer:  " + computerDie.getValue());
                                    rollTies += 1;
                            }//end if..else if statments
                    }//end for loop
                    //This block of code will determine who the winner is based on the 
                    //amount of rolls won.
                    if(userWins > computerWins){
                            JOptionPane.showMessageDialog(null, "Player wins!\n" 
                                                        + "Player won: " + userWins + " rolls"
                                                        + "\nComputer won:  " + computerWins + " rolls"
                                                        + "\nTies: " + rollTies);
                    }else if(userWins < computerWins){
                            JOptionPane.showMessageDialog(null, "Computer wins!\n" 
                                                        + "Player won: " + userWins + " rolls"
                                                        + "\nComputer won:  " + computerWins + " rolls"
                                                        + "\nTies: " + rollTies);
                    }else if(userWins == computerWins){
                            JOptionPane.showMessageDialog(null, "It's a tie!\n" 
                                                        + "Player won: " + userWins + " rolls"
                                                        + "\nComputer won:  " + computerWins + " rolls"
                                                        + "\nTies: " + rollTies);
                    }//end if..else if statments
                    continueInt = JOptionPane.showConfirmDialog(null, "Do you want to play again?");
                }while(continueInt == 0);				
	}//end main method	
}//end class Problem14()