package org.netbeans.modules.cloud.foo;
import java.util.concurrent.Callable;
import java.util.concurrent.Future;
import javax.swing.SwingUtilities;
import org.netbeans.api.annotations.common.StaticResource;
import org.netbeans.api.server.ServerInstance;
import org.netbeans.modules.cloud.foo.serverplugin.FooServerInstance;
import org.openide.util.RequestProcessor;
public class FooCloudInstance {
    @StaticResource
    public static final String ICON = "org/netbeans/modules/cloud/foo/resources/icon.png";
    public static final String TYPE = "Foo";
    private final String displayText;
    private final String userName;
    private final String password;
    private ServerInstance serverInstance;
    private FooServerInstance fooServerInstance;
    private static final RequestProcessor FOO_RP = new RequestProcessor(FooCloudInstance.TYPE, 1); // NOI18N
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
    public static <T> Future<T> runAsynchronously(Callable<T> callable) {
        return runAsynchronously(callable, null);
    }
    public static synchronized <T> Future<T> runAsynchronously(Callable<T> callable, FooCloudInstance ai) {
        Future<T> f = FOO_RP.submit(callable);
        return f;
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
