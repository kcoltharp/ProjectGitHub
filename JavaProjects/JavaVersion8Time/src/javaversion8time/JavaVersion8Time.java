package javaversion8time;

import com.sun.scenario.effect.impl.sw.java.JSWBlend_MULTIPLYPeer;
import java.sql.Time;
import java.util.concurrent.TimeUnit;
import javax.management.MBeanServerInvocationHandler;
import org.omg.PortableServer.POAPackage.AdapterAlreadyExistsHelper;

/**
 *
 * @author Kenny
 */
public class JavaVersion8Time{
	public enum daysOfWeek{SUNDAY, MONDAY, TUESDAY, WEDNESDAY, THURSDAY, FRIDAY, SATURDAY};
	public enum monthsOfYear{JANUARY, FEBRUARY, MARCH, APRIL, MAY, JUNE, JULY, AUGUST, SEPTEMBER, OCTOBER, NOVEMBER, DECEMBER};
	int[] hoursOfDay = {1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22, 23, 00};
	int hour, minute, second;
	static String stTime = "";

	public JavaVersion8Time(int h, int m, int s) {
		hour = h;
		minute = m;
		second = s;
		this.setTime(h, m, s);
	}
	
	private String setTime(int h, int m, int s){
		long hourMilli = TimeUnit.HOURS.toMillis((long) h);
		long minMilli = TimeUnit.MINUTES.toMillis((long) m);
		long secMilli = TimeUnit.SECONDS.toMillis((long) s);
		long milliSec = hourMilli + minMilli + secMilli;
		Time time = new Time(milliSec);
		stTime = time.toString();
		return stTime;
	}
	
	public String getTime(){
		String currentTime = this.stTime;
		
		return currentTime;
	}

	public static void main(String[] args) {
		
		JavaVersion8Time myTime = new JavaVersion8Time(1, 0, 2);
		System.out.println(stTime);
		
	}
	
}
