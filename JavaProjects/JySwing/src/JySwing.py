# Demonstrate usage of Java Swing classes in Jython

from java.awt import BorderLayout
from javax import swing

__author__ = "Amit Saha <amitksaha@netbeans.org>"
__date__ = "$29 Nov, 2008 12:59:25 AM$"


class SimpleFrame():

    def __init__(self):
        """We shall create the JFrame with a label and a button"""
	print "Initializing"

    def draw(self):


        #Create a JFrame and add a label, button and a menu bar
        self.frame = swing.JFrame("Hello Swing from Python", visible=1 )


        # a JLabel
        self.label = swing.JLabel("This is a Swing app in Jython")


        # a JButton
        self.button = swing.JButton("Click me!")
        

        # Adding a action
        self.button.actionPerformed = self.ClickBtn


        self.frame.contentPane.add(self.label, BorderLayout.CENTER)
        self.frame.contentPane.add(self.button, BorderLayout.SOUTH)

        self.frame.defaultCloseOperation = swing.JFrame.EXIT_ON_CLOSE;

        self.frame.pack()

    


    def ClickBtn(self, event):
        """handle button click"""

        self.label.setText("Clicked!")


if __name__ == '__main__':
    frame = SimpleFrame()
    frame.draw()
