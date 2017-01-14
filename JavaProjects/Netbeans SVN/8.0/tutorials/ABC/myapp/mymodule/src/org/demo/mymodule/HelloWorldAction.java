package org.demo.mymodule;

import java.awt.event.ActionEvent;
import java.awt.event.ActionListener;
import javax.swing.JOptionPane;
import org.openide.awt.ActionRegistration;
import org.openide.awt.ActionReference;
import org.openide.awt.ActionReferences;
import org.openide.awt.ActionID;
import org.openide.util.NbBundle.Messages;

@ActionID(category = "Window",
id = "org.demo.mymodule.HelloWorldAction")
@ActionRegistration(displayName = "#CTL_HelloWorldAction")
@ActionReferences({
    @ActionReference(path = "Menu/Window", position = -100)
})
@Messages("CTL_HelloWorldAction=Hello World")
public final class HelloWorldAction implements ActionListener {

    public void actionPerformed(ActionEvent e) {
        JOptionPane.showMessageDialog(null, "hello...");
    }
    
}