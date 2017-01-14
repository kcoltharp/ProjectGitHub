package org.netbeans.modules.cloud.foo.serverplugin;
import java.util.ArrayList;
import java.util.Collections;
import java.util.HashMap;
import java.util.List;
import java.util.Map;
import java.util.concurrent.Callable;
import java.util.concurrent.Future;
import javax.swing.event.ChangeEvent;
import javax.swing.event.ChangeListener;
import org.netbeans.api.server.ServerInstance;
import org.netbeans.modules.cloud.foo.FooCloudInstance;
import org.netbeans.modules.cloud.foo.FooCloudInstanceManager;
import org.netbeans.modules.j2ee.deployment.plugins.api.InstanceCreationException;
import org.netbeans.modules.j2ee.deployment.plugins.api.InstanceProperties;
import org.netbeans.spi.server.ServerInstanceFactory;
import org.netbeans.spi.server.ServerInstanceProvider;
import org.openide.util.ChangeSupport;
import org.openide.util.Exceptions;
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
    public void refreshServersSynchronously() {
        List<ServerInstance> servers = new ArrayList<ServerInstance>();
        for (FooCloudInstance fooCloudInstance : FooCloudInstanceManager.getDefault().getInstances()) {
            FooServerInstance fooServerInstance = fooCloudInstance.readFooServerInstance();
            ServerInstance serverInstance = ServerInstanceFactory.createServerInstance(new FooServerInstanceImplementation(fooServerInstance));
            InstanceProperties ip = InstanceProperties.getInstanceProperties(fooServerInstance.getId());
            if (ip == null) {
                Map<String, String> props = new HashMap<String, String>();
                String type = FooCloudInstance.TYPE;
                String user = fooCloudInstance.getUserName();
                String password = fooCloudInstance.getPassword();
//                props.put(OpenShiftDeploymentFactory.IP_ENVIRONMENT_ID, osjeei.getEnvironmentId());
//                props.put(OpenShiftDeploymentFactory.IP_APPLICATION_NAME, osjeei.getApplicationName());
//                props.put(FooDeploymentFactory.IP_USER_NAME, user);
//                props.put(FooDeploymentFactory.IP_PASSWORD, password);
                try {
                    ip = InstanceProperties.createInstancePropertiesNonPersistent(fooServerInstance.getId(),
                            user, password, type, props);
                } catch (InstanceCreationException ex) {
                    Exceptions.printStackTrace(ex);
                }
            }
            fooCloudInstance.setServerInstance(serverInstance);
            servers.add(serverInstance);
        }
        this.instances = servers;
        listeners.fireChange();
    }
    public final Future<Void> refreshServers() {
        return FooCloudInstance.runAsynchronously(new Callable<Void>() {
            @Override
            public Void call() throws Exception {
                refreshServersSynchronously();
                return null;
            }
        });
    }
    @Override
    public void stateChanged(ChangeEvent e) {
        refreshServers();
    }
}
