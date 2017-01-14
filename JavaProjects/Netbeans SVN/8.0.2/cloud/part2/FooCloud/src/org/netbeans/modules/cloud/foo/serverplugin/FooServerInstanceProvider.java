package org.netbeans.modules.cloud.foo.serverplugin;
import java.util.ArrayList;
import java.util.Collections;
import java.util.List;
import javax.swing.event.ChangeEvent;
import javax.swing.event.ChangeListener;
import org.netbeans.api.server.ServerInstance;
import org.netbeans.modules.cloud.foo.FooCloudInstance;
import org.netbeans.modules.cloud.foo.FooCloudInstanceManager;
import org.netbeans.spi.server.ServerInstanceFactory;
import org.netbeans.spi.server.ServerInstanceProvider;
import org.openide.util.ChangeSupport;
public final class FooServerInstanceProvider implements ServerInstanceProvider, ChangeListener {
    private final ChangeSupport listeners;
    private List<ServerInstance> instances;
    private static FooServerInstanceProvider instance;
    private FooServerInstanceProvider() {
        listeners = new ChangeSupport(this);
        instances = Collections.<ServerInstance>emptyList();
        refreshServers();
    }
    public static synchronized FooServerInstanceProvider getProvider() {
        if (instance == null) {
            instance = new FooServerInstanceProvider();
            FooCloudInstanceManager.getDefault().addChangeListener(instance);
        }
        return instance;
    }
    @Override
    public List<ServerInstance> getInstances() {
        synchronized (this) {
            return new ArrayList<ServerInstance>(instances);
        }
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
        for (FooCloudInstance fooCloudInstance : FooCloudInstanceManager.getDefault().getInstances()) {
            FooServerInstance fooServerInstance = fooCloudInstance.readFooServerInstance();
            ServerInstance serverInstance = ServerInstanceFactory.createServerInstance(new FooServerInstanceImplementation(fooServerInstance));
            fooCloudInstance.setServerInstance(serverInstance);
            servers.add(serverInstance);
        }
        synchronized (this) {
            instances = servers;
        }
        listeners.fireChange();
    }
    @Override
    public void stateChanged(ChangeEvent e) {
        refreshServers();
    }
}
