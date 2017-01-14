package org.netbeans.modules.cloud.foo;
import java.io.File;
import java.util.concurrent.Callable;
import java.util.concurrent.Future;
import java.util.logging.Level;
import java.util.logging.Logger;
import javax.swing.SwingUtilities;
import org.netbeans.api.annotations.common.StaticResource;
import org.netbeans.api.project.FileOwnerQuery;
import org.netbeans.api.project.Project;
import org.netbeans.api.project.ProjectUtils;
import org.netbeans.api.server.ServerInstance;
import org.netbeans.modules.cloud.common.spi.support.serverplugin.DeploymentStatus;
import org.netbeans.modules.cloud.common.spi.support.serverplugin.ProgressObjectImpl;
import org.netbeans.modules.cloud.foo.serverplugin.FooServerInstance;
import org.netbeans.modules.cloud.foo.utils.OpenShiftUtilities;
import org.openide.filesystems.FileObject;
import org.openide.filesystems.FileUtil;
import org.openide.util.RequestProcessor;
import org.openide.windows.IOProvider;
import org.openide.windows.InputOutput;
import org.openide.windows.OutputWriter;
public class FooCloudInstance {
    @StaticResource
    public static final String ICON = "org/netbeans/modules/cloud/foo/resources/icon.png";
    public static final String TYPE = "Foo";
    private final String displayText;
    public static String userName;
    public static String password;
    private ServerInstance serverInstance;
    private FooServerInstance fooServerInstance;
    private static final Logger LOG = Logger.getLogger(FooCloudInstance.class.getSimpleName());
    private static final RequestProcessor FOO_RP = new RequestProcessor(FooCloudInstance.TYPE, 1); // NOI18N
    public FooCloudInstance(String displayText, String userName, String password) {
        this.displayText = displayText;
        FooCloudInstance.userName = userName;
        FooCloudInstance.password = password;
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
    public void deregisterJ2EEServerInstances() {
        FooServerInstance instance;
        synchronized (this) {
            instance = fooServerInstance;
        }
        if (instance != null) {
            instance.deregister();
        }
    }
    public static Future<DeploymentStatus> deployAsync(final File f, final ProgressObjectImpl po) {
        return runAsynchronously(new Callable<DeploymentStatus>() {
            @Override
            public DeploymentStatus call() throws Exception {
                FileObject fo = FileUtil.toFileObject(f);
                Project project = FileOwnerQuery.getOwner(fo);
                String projectName = ProjectUtils.getInformation(project).getDisplayName();
                DeploymentStatus ds = deploy(project, po);
                LOG.log(Level.INFO, "deployment result: {0}", ds); // NOI18N
                String url = OpenShiftUtilities.getURL(projectName);
                po.updateDepoymentResult(ds, url);
                return ds;
            }
        });
    }
    public static DeploymentStatus deploy(Project project, ProgressObjectImpl po) {
        assert !SwingUtilities.isEventDispatchThread();
        OutputWriter ow = null;
        OutputWriter owe = null;
        try {
            String projectName = ProjectUtils.getInformation(project).getDisplayName();
            String tabName = "Deployment Output";
            InputOutput io = IOProvider.getDefault().getIO(tabName, false);
            if (io.isClosed()) {
                io = IOProvider.getDefault().getIO(tabName, true);
            }
            ow = io.getOut();
            owe = io.getErr();
            if (po != null) {
                po.updateDepoymentStage("Uploading...");
                ow.println("Uploading");
            }
            OpenShiftUtilities.connect2OpenShift(projectName, po, ow);
        } catch (Throwable t) {
            if (owe != null) {
                t.printStackTrace(owe);
            }
            return DeploymentStatus.UNKNOWN;
        } finally {
            if (ow != null) {
                ow.close();
            }
            if (owe != null) {
                owe.close();
            }
        }
        return DeploymentStatus.SUCCESS;
    }
}
