package org.netbeans.modules.cloud.foo;
import javax.swing.SwingUtilities;
import org.netbeans.api.server.ServerInstance;
import org.netbeans.modules.cloud.foo.serverplugin.FooServerInstance;
public class FooCloudInstance {
    private final String displayText;
    private final String userName;
    private final String password;
    private ServerInstance serverInstance;
    private FooServerInstance fooServerInstance;
    public FooCloudInstance(String displayText, String userName, String password) {
        this.displayText = displayText;
        this.userName = userName;
        this.password = password;
    }
    public String getDisplayText() {
        return displayText;
    }
    public String getUserName() {
        return userName;
    }
    public String getPassword() {
        return password;
    }
    public ServerInstance getServerInstance() {
        return serverInstance;
    }
    public void setServerInstance(ServerInstance serverInstance) {
        this.serverInstance = serverInstance;
    }
    public FooServerInstance readFooServerInstance() {
        assert !SwingUtilities.isEventDispatchThread();
        FooServerInstance inst = new FooServerInstance(this);
        synchronized (this) {
            fooServerInstance = inst;
            return fooServerInstance;
        }
    }
}
