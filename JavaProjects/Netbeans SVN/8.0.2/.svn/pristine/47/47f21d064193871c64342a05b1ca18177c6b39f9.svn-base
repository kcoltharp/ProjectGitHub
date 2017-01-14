package org.netbeans.modules.cloud.foo;
import java.util.ArrayList;
import java.util.List;
import javax.swing.event.ChangeListener;
import org.netbeans.api.server.properties.InstanceProperties;
import org.netbeans.api.server.properties.InstancePropertiesManager;
import org.openide.util.ChangeSupport;
public class FooCloudInstanceManager {
    private static FooCloudInstanceManager instance;
    private static final String FOO_IP_NAMESPACE = "cloud.foo"; // NOI18N
    private final List<FooCloudInstance> instances = new ArrayList<FooCloudInstance>();
    private final ChangeSupport listeners;
    public static synchronized FooCloudInstanceManager getDefault() {
        if (instance == null) {
            instance = new FooCloudInstanceManager();
        }
        return instance;
    }
    public FooCloudInstanceManager() {
        listeners = new ChangeSupport(this);
        init();
    }
    private void init() {
        instances.addAll(load());
        notifyChange();
    }
    private void notifyChange() {
        listeners.fireChange();
    }
    public List<FooCloudInstance> getInstances() {
        return instances;
    }
    public void add(FooCloudInstance fooInstance) {
        store(fooInstance);
        instances.add(fooInstance);
        notifyChange();
    }
    private static List<FooCloudInstance> load() {
        List<FooCloudInstance> result = new ArrayList<FooCloudInstance>();
        for (InstanceProperties props : InstancePropertiesManager.getInstance().getProperties(FOO_IP_NAMESPACE)) {
            String userName = props.getString("userName", null); // NOI18N
            String password = props.getString("password", null); // NOI18N
            result.add(new FooCloudInstance(userName, password));
        }
        return result;
    }
    private void store(FooCloudInstance fooInstance) {
        List<InstanceProperties> list = InstancePropertiesManager.getInstance().getProperties(FOO_IP_NAMESPACE);
        if (list == null) {
            InstanceProperties props = InstancePropertiesManager.getInstance().createProperties(FOO_IP_NAMESPACE);
            props.putString("userName", fooInstance.getUserName()); // NOI18N
            props.putString("password", fooInstance.getPassword()); // NOI18N
        }
    }
    public void addChangeListener(ChangeListener l) {
        listeners.addChangeListener(l);
    }
    public void removeChangeListener(ChangeListener l) {
        listeners.removeChangeListener(l);
    }
    public void remove(FooCloudInstance fci) {
        for (InstanceProperties props : InstancePropertiesManager.getInstance().getProperties(FOO_IP_NAMESPACE)) {
            props.remove();
            break;
        }
        instances.remove(fci);
        fci.deregisterJ2EEServerInstances();
        notifyChange();
    }
}
