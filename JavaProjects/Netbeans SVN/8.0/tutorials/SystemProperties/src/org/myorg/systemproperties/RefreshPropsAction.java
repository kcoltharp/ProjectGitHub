package org.myorg.systemproperties;

import org.openide.util.NbBundle.Messages;
import java.awt.event.ActionEvent;
import javax.swing.AbstractAction;

public class RefreshPropsAction extends AbstractAction {

    @Messages("LBL_RefreshProps=Refresh")
    public RefreshPropsAction() {
        super(Bundle.LBL_RefreshProps());
    }

    @Override
    public void actionPerformed(ActionEvent e) {
        PropertiesNotifier.changed();
    }
    
}