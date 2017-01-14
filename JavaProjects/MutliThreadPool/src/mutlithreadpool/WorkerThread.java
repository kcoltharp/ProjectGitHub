/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package mutlithreadpool;

/**
 *
 * @author Kenny
 */
public class WorkerThread
{
	private int workerNumber;

	WorkerThread(int number)
	{
		workerNumber = number;
	}

	public void run()
	{
		for (int i = 0; i <= 100; i += 20)
		{
			// Perform some work ...
			System.out.println("Worker number: " + workerNumber
						    + ", percent complete: " + i);
			try
			{
				Thread.sleep((int) (Math.random() * 1000));
			}
			catch (InterruptedException e)
			{
			}
		}
	}

}
