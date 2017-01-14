package time;

public class Time {
	
	private int hour;
	private int minute;
	private int second;
	
	public void setTime(int h, int m, int s){
		hour = ( (h >= 0 && h < 24) ? h : 0);
		minute = ( (m >= 0 && m < 60) ? m : 0);
		second = ( (m >= 0 && m < 60) ? m : 0);
	}//end method setTime
	
	public String toUniversalString(){
		return String.format("%02d:%02d:%02d", hour, minute, second);
	}//end method toUniversalString
	
	@Override
	public String toString(){
		return String.format("%d:%02d:%02d %s",( (hour == 0 || hour == 12) ? 12 : hour % 12) , 
					minute, second, (hour < 12 ? "AM" : "PM") );		
	}//end method toString

	public static void main(String[] args) {
		Time time = new Time();
		
		System.out.print("The initial universal time is: ");
		System.out.println(time.toUniversalString());		
		System.out.print("The initial standard time is: ");
		System.out.println(time.toString() + "\n");
		
		time.setTime(16, 06, 30);
		System.out.print("The universal time after setTime is: ");
		System.out.println(time.toUniversalString());
		System.out.print("The standard time after setTime is: ");
		System.out.println(time.toString() + "\n");
		
		time.setTime(99, 99, 99);
		System.out.print("After attempting setTime to invalid settings\n Universal time is: ");
		System.out.println(time.toUniversalString());
		System.out.print("Standard time is: ");
		System.out.println(time.toString() + "\n");
	}
	
}
