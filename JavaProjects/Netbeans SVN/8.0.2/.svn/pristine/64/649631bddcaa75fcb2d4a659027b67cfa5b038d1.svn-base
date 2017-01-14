package org.netbeans.modules.cloud.foo;
import java.util.ArrayList;
import java.util.List;
import javax.swing.event.ChangeListener;
import org.netbeans.api.server.properties.InstanceProperties;
import org.netbeans.api.server.properties.InstancePropertiesManager;
import org.openide.util.ChangeSupport;
public class FooServerInstanceManager {
    private static FooServerInstanceManager instance;
    private static final String FOO_IP_NAMESPACE = "cloud.foo"; // NOI18N
    private final List<FooInstance> instances = new ArrayList<FooInstance>();
    private final ChangeSupport listeners;
    public static synchronized FooServerInstanceManager getDefault() {
        if (instance == null) {
            instance = new FooServerInstanceManager();
        }
        return instance;
    }
    public FooServerInstanceManager() {
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
    public List<FooInstance> getInstances() {
        return instances;
    }
    public void add(FooInstance fooInstance) {
        store(fooInstance);
        instances.add(fooInstance);
        notifyChange();
    }
    private static List<FooInstance> load() {
        List<FooInstance> result = new ArrayList<FooInstance>();
        for (InstanceProperties props : InstancePropertiesManager.getInstance().getProperties(FOO_IP_NAMESPACE)) {
            String name = props.getString("name", null); // NOI18N
            assert name != null : "Instance without name";
            result.add(new FooInstance(name));
        }
        return result;
    }
    private void store(FooInstance fooInstance) {
        InstanceProperties props = InstancePropertiesManager.getInstance().createProperties(FOO_IP_NAMESPACE);
        props.putString("name", fooInstance.getName()); // NOI18N
    }
    public void addChangeListener(ChangeListener l) {
        listeners.addChangeListener(l);
    }
    public void removeChangeListener(ChangeListener l) {
        listeners.removeChangeListener(l);
    }
}
