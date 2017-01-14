package org.netbeans.lnb;

import java.awt.event.ActionEvent;
import java.awt.event.ActionListener;
import org.openide.awt.ActionID;
import org.openide.awt.ActionReference;
import org.openide.awt.ActionRegistration;
import org.openide.util.NbBundle.Messages;

@ActionID(
        category = "File",
        id = "org.netbeans.lnb.RunLazybones"
)
@ActionRegistration(
        asynchronous = true,
        displayName = "#CTL_RunLazybones"
)
@ActionReference(path = "Menu/File", position = 0)
@Messages("CTL_RunLazybones=Run Lazybones")
public final class RunLazybones implements ActionListener {

    @Override
    public void actionPerformed(ActionEvent e) {
        String name = "my-rat-app-1";
        LNBUtils.command(name);
    }

}
