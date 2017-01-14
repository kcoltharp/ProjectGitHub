package org.netbeans.modules.cloud.openshift;
import java.util.ArrayList;
import java.util.Collections;
import java.util.List;
import javax.swing.event.ChangeEvent;
import javax.swing.event.ChangeListener;
import org.netbeans.api.server.ServerInstance;
import org.netbeans.spi.server.ServerInstanceFactory;
import org.netbeans.spi.server.ServerInstanceProvider;
import org.openide.util.ChangeSupport;
/**
 * Provider of registered OpenShift accounts in the IDE.
 */
public class OpenShiftServerInstanceProvider implements ServerInstanceProvider, ChangeListener {
    private ChangeSupport listeners;
    private List<ServerInstance> instances;
    private static OpenShiftServerInstanceProvider instance;
    private OpenShiftServerInstanceProvider() {
        listeners = new ChangeSupport(this);
        instances = Collections.<ServerInstance>emptyList();
        OpenShiftInstanceManager.getDefault().addChangeListener(this);
        refreshServers();
    }
    public static synchronized OpenShiftServerInstanceProvider getProvider() {
        if (instance == null) {
            instance = new OpenShiftServerInstanceProvider();
        }
        return instance;
    }
    @Override
    public List<ServerInstance> getInstances() {
        return instances;
    }
    @Override
    public void addChangeListener(ChangeListener listener) {
        listeners.addChangeListener(listener);
    }
    @Override
    public void removeChangeListener(ChangeListener listener) {
        listeners.removeChangeListener(listener);
    }
    private void refreshServers() {
        List<ServerInstance> servers = new ArrayList<ServerInstance>();
        for (OpenShiftInstance ai : OpenShiftInstanceManager.getDefault().getInstances()) {
            ServerInstance si = ServerInstanceFactory.createServerInstance(new OpenShiftServerInstanceImplementation(ai));
            ai.setServerInstance(si);
            servers.add(si);
        }
        this.instances = servers;
        listeners.fireChange();
    }
    @Override
    public void stateChanged(ChangeEvent e) {
        refreshServers();
    }
}
