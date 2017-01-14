package org.geotools.mygeospatialsystem.utils;

import javax.swing.UIManager;
import org.openide.windows.OnShowing;

@OnShowing
public class Installer implements Runnable {

    @Override
    public void run() {
        UIManager.put("EditorTabDisplayerUI", "org.geotools.mygeospatialsystem.utils.NoTabsTabDisplayerUI");
    }
    
}
