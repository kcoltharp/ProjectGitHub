package org.netbeans.modules.cloud.foo.serverplugin;
import org.netbeans.api.server.ServerInstance;
import org.netbeans.modules.cloud.common.spi.support.serverplugin.InstanceState;
import org.netbeans.modules.cloud.foo.FooCloudInstance;
import org.netbeans.modules.j2ee.deployment.plugins.api.InstanceProperties;
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
    public String getDisplayName() {
        return FooCloudInstance.TYPE;
    }
    public String getId() {
        return createURL("foo:", fooInstance.getUserName(), "BBB");
    }
    public static String createURL(String cloudInstance, String identityDomain, String javaServiceName) {
        return cloudInstance + "." + identityDomain + "." + javaServiceName;
    }
    public void deregister() {
        InstanceProperties.removeInstance(getId());
    }
    @Override
    public String toString() {
        return "FooServerInstance{" + "fooServerInstance=" + fooInstance + ", state=" + state +  "}";
    }
}
