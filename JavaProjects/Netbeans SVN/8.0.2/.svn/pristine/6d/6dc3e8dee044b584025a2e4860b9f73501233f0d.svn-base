package org.netbeans.modules.cloud.foo;
import java.util.ArrayList;
import java.util.Collections;
import java.util.List;
import javax.swing.event.ChangeEvent;
import javax.swing.event.ChangeListener;
import org.netbeans.api.server.ServerInstance;
import org.netbeans.spi.server.ServerInstanceFactory;
import org.netbeans.spi.server.ServerInstanceProvider;
import org.openide.util.ChangeSupport;
public class FooCloudInstanceProvider implements ServerInstanceProvider, ChangeListener {
    private static FooCloudInstanceProvider instance;
    private List<ServerInstance> instances;
    private final ChangeSupport listeners;
    private FooCloudInstanceProvider() {
        listeners = new ChangeSupport(this);
        instances = Collections.<ServerInstance>emptyList();
        FooCloudInstanceManager.getDefault().addChangeListener(this);
        refreshServers();
    }
    public static synchronized FooCloudInstanceProvider getProvider() {
        if (instance == null) {
            instance = new FooCloudInstanceProvider();
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
    @Override
    public void stateChanged(ChangeEvent e) {
        refreshServers();
    }
    private void refreshServers() {
        List<ServerInstance> servers = new ArrayList<ServerInstance>();
        for (FooCloudInstance fooInstance : FooCloudInstanceManager.getDefault().getInstances()) {
            servers.add(ServerInstanceFactory.createServerInstance(new FooCloudInstanceImplementation(fooInstance)));
        }
        this.instances = servers;
        listeners.fireChange();
    }
}
