package chapter6.problem11;

import javax.swing.JOptionPane;

/**
 *
 * @author	Kenny Coltharp
 *  Date	July 4, 2015
 *  Version	1.0
 *  Purpose:	This class will ask the user to enter a temperature.
 *		Then it will take that temperature, instantiate the
 *		class FreezingBoilingTemps() with the given temp.
 *		The creation of that class object will include checking
 *		the temperature against substances that will freeze or
 *		boil. A window will open and give the user any substances
 *		that will either freeze or boil at that given temperature.
 *		Then it will ask the user if they would like to check
 *		another temperature or quit.
 */
public class Problem11 {

	/**
	 * @param args the command line arguments
	 */
	public static void main(String[] args) {
		int returnNum;
		int tempToCheck;
		String tempString;
		
		do{
			//get the temperature to check the substances against.
			tempString = JOptionPane.showInputDialog("Enter the temperature you want to check the "
				   + "substances for either a boiling or freezing point.");
			
			//convert the string to an integer.
			tempToCheck = Integer.parseInt(tempString);
			
			//instantiate the class, which checks the substances freezing and boiling points
			//agains the temerature the user input.
			FreezingBoilingTemps freezeBoil = new FreezingBoilingTemps(tempToCheck);
			
			//determine if the user wants to continue checking temperatures
			returnNum = JOptionPane.showConfirmDialog(null, "Would you like to enter another "
				   + "temperature to check?");
		
		//if user chooses to continue the returnNum will be 0, if they select No it will be 1, and 
		//if they select cancel it will be 2.
		}while((returnNum == 0) | ((returnNum != 1) & (returnNum != 2)));//end do...while loop|
	}//end method main	
}//end class Problem11