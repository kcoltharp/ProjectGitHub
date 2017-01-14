/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package gradebook;

import java.util.Scanner;

/**
 *
 * @author Kenny
 */
public class GradeBook {

	//name of the course this grade book represents
	private String courseName;
	private int [][] grades;
	//private int total, gradeCounter, aCount, bCount, cCount, dCount, fCount;
	
	
	//constructor initializes course name
	public GradeBook(String name, int [][] gradesArray){
		courseName = name;
		grades = gradesArray;
	}
	
	//method to set course name
	public void setCourseName(String name){
		courseName = name;
	}//end mthod setCourseName
	
	//method to get course name
	public String getCourseName(){
		return courseName;
	}//end method getCourseName
	
	//method to display intro to the gradebook for this course
	public void displayMessage(){
		System.out.printf("Welcome to the grade book for \n%s!\n", getCourseName());
	}//end method displayMessage
	
	//method to determine the average of a number of grades
	public void inputGrades(){
		Scanner input = new Scanner(System.in);
		
		double grade;
		double average;
		int total = 0;
		int gradeCounter = 0;
		
		String range = "Enter the integer grades in the range 0-100.\nTo finish entering grades, "
			   + "enter any letter!";
				
		System.out.printf("\n%s\n", range);
		
		while (input.hasNextDouble()) {
			grade = input.nextDouble();
			total += grade;
			++gradeCounter;			
		}//end while loop		
	}//end method determineClassAverage
	
	public void processGrades(){
		
	
		outputGrades();
		//System.out.printf("Class average is %.2f\n", getAverage());	
		System.out.printf("Lowest grade is %d\nHighest grade is %d\n\n", getMinimum(), getMaximum());
		outputBarChart();
	}//end method processGrades
	
	public int getMinimum(){
		int lowGrade = grades[0][0];
		
		for(int[] studentGrades : grades){
			for(int grade : studentGrades){
				if(grade < lowGrade){
					lowGrade = grade;
				}//end if
			}//end inner for loop
		}//end for loop
		
		return lowGrade;
	}//end method getMinimum
	
	public int getMaximum(){
		int highGrade = grades[0][0];
		
		for(int[] studentGrades  : grades){
			for(int grade : studentGrades){
				if(grade > highGrade){
					highGrade = grade;
				}//end if
			}//end inner for loop
		}//end for loop		
		return highGrade;
	}//end method getMaximum
	
	public double getAverage(int[] setOfGrades){
		int total = 0;
		
		for(int grade : setOfGrades){
			total += grade;			
		}//end for loop		
		return (double) total / grades.length;
	}//end method getAverage
	
	public void outputBarChart(){
		System.out.println("Grade distribution:");
		
		int[] frequency = new int[11];
		for(int[] studentGrades : grades){
			for(int grade : studentGrades){
				++frequency[grade / 10];
			}//end inner for loop			
		}//end outer for loop
		
		for(int count = 0; count < frequency.length; count++){
			if(count == 10){
				System.out.printf("%5d: ", 100);
			}else{
				System.out.printf("%02d-%02d: ", count * 10, count * 10 + 9);
			}//end if/else
			
			for(int stars = 0; stars < frequency[count]; stars++){
				System.out.print("*");
			}//end for loop
			System.out.println();
		}//end outer for loop
	}//end method outputBarChart
	
	public void outputGrades(){
		System.out.println("The grades are:\n");
		System.out.println("                           ");
		
		String t = "Test ";
		for(int test = 0; test < grades[0].length; test++){
			if(test == 0){
				System.out.printf("%s %9dst ",t , test + 1);
			}
			else if (test == 1){
				System.out.printf("%s %9dnd ",t , test + 1);
			}
			else if (test == 2){
				System.out.printf("%s %9drd ",t , test + 1);
			}else{
				System.out.printf("%s %9dth ",t , test + 1);
			}
			
		}//end for loop
		
		System.out.println("Average");
		
		String st = "Student";		
		for(int student = 0; student < grades.length; student++){
			System.out.printf("%s %2d:  ",st , student + 1);
			
			for(int test : grades[student]){
				System.out.printf("%8d:  ", test);
			}//end inner for loop
			
			double average = getAverage(grades[student]);
			System.out.printf("%9.2f\n", average);
		}//end outer for loop
	}//end method outputGrades
	
	public static void main(String[] args){
		
		int[][] gradesArray = { 
			{87, 68, 94, 88},
			{99, 83, 78, 94},
			{85, 91, 76, 93},
			{65, 96, 78, 88},
			{95, 96, 89, 98},
			{97, 93, 90, 99}
		};
		
		//create gradebook object and pass course name to constructor
		GradeBook myGradeBook = new GradeBook("CPT 262 Java Programming", gradesArray);
		
		//display welcome message		
		myGradeBook.displayMessage();
		//myGradeBook.inputGrades();
		myGradeBook.processGrades();
	}//end main method
}//end class GradeBook
