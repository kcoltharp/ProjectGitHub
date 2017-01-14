package stringoperations;

import java.util.Scanner;

/**
 *
 * @author Kenny
 */
public class StarChart {
	public static void main(String[] args) {
		int rows, cols;
		Scanner input = new Scanner(System.in);
		
		System.out.println("How many rows? ");
		rows = input.nextInt();
		System.out.println("How many columns? ");
		cols = input.nextInt();
		
		for (int r = 0; r < rows; r++) {
			for (int c = 0; c < cols; c++) {
				System.out.print("*");
			}
			System.out.println();
		}
	}
	
}
