package org.demo.mymodule;

import org.openide.awt.ActionID;
import org.openide.awt.ActionReference;
import org.openide.windows.TopComponent;
import org.openide.util.NbBundle.Messages;
import static org.demo.mymodule.Bundle.*;

@TopComponent.Description(preferredID = "HelloTopComponent",
persistenceType = TopComponent.PERSISTENCE_ALWAYS)
@TopComponent.Registration(mode = "editor", openAtStartup = true)
@ActionID(category = "Window", id = "org.demo.mymodule.HelloTopComponent")
@ActionReference(path = "Menu/Window" /*, position = 333 */)
@TopComponent.OpenActionRegistration(displayName = "#CTL_HelloAction",
preferredID = "HelloTopComponent")
@Messages(
        {"CTL_HelloAction=Open Hello Window",
        "NAME_Hello=Hello Window"
        })
public class HelloWorldTopComponent extends TopComponent {

    public HelloWorldTopComponent() {
        setDisplayName(NAME_Hello());
    }
                
    @Override
    public void componentOpened() {
    }

    @Override
    public void componentClosed() {
    }

}