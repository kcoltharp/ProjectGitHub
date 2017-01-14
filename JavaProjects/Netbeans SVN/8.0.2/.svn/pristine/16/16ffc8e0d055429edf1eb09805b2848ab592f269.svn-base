package org.netbeans.modules.cloud.foo.serverplugin;
import org.netbeans.api.server.ServerInstance;
import org.netbeans.modules.cloud.common.spi.support.serverplugin.InstanceState;
import org.netbeans.modules.cloud.foo.FooCloudInstance;
import org.netbeans.modules.j2ee.deployment.plugins.api.InstanceProperties;
import org.openide.util.NbBundle;
public class FooServerInstance {
    private FooCloudInstance fooInstance;
    private InstanceState state;
    private ServerInstance instance;
    private InstanceProperties ip;
    public FooServerInstance(FooCloudInstance oracleInstance) {
        this.fooInstance = oracleInstance;
        this.state = InstanceState.READY;
    }
    public FooCloudInstance getFooInstance() {
        return fooInstance;
    }
    public void updateState(String stateDesc) {
        state = InstanceState.READY;
    }
    public ServerInstance getInstance() {
        return instance;
    }
    void setInstance(ServerInstance instance) {
        this.instance = instance;
    }
    public InstanceProperties getInstanceProperties() {
        return ip;
    }
    void setInstanceProperties(InstanceProperties ip) {
        this.ip = ip;
    }
    public InstanceState getState() {
        return state;
    }
    public void setFooInstance(FooCloudInstance fooInstance) {
        this.fooInstance = fooInstance;
    }
    @NbBundle.Messages("CTL_DISPLAYNAME=Foo")
    public String getDisplayName() {
        return Bundle.CTL_DISPLAYNAME();
    }
    public String getId() {
        return getFooInstance().getDisplayText();
    }
    public void deregister() {
        InstanceProperties.removeInstance(getId());
    }
}
