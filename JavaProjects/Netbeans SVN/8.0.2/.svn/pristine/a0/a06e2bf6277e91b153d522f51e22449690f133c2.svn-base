package org.netbeans.modules.cloud.foo.utils;
import com.openshift.client.IApplication;
import com.openshift.client.IDomain;
import com.openshift.client.IOpenShiftConnection;
import com.openshift.client.IUser;
import com.openshift.client.OpenShiftConnectionFactory;
import com.openshift.client.cartridge.IEmbeddedCartridge;
import com.openshift.client.cartridge.query.LatestVersionOf;
import java.util.List;
import org.netbeans.modules.cloud.common.spi.support.serverplugin.ProgressObjectImpl;
import static org.netbeans.modules.cloud.foo.FooCloudInstance.password;
import static org.netbeans.modules.cloud.foo.FooCloudInstance.userName;
import org.openide.windows.OutputWriter;
public class OpenShiftUtilities {
    private static IApplication app;
    private static IDomain domain;
    public static String getURL(String projectName) {
        return "https://" + projectName + "-" + domain.getId() + ".rhcloud.com";
    }
    public static void connect2OpenShift(String projectName, ProgressObjectImpl po, OutputWriter ow) {
        IOpenShiftConnection connection = new OpenShiftConnectionFactory().getConnection("netbeans", userName, password);
        IUser user = connection.getUser();
        domain = user.getDefaultDomain();
        boolean redeploy = false;
        List<IApplication> apps = domain.getApplications();
        for (IApplication app : apps) {
            if (app.getName().toLowerCase().equals(projectName.toLowerCase())) {
                redeploy = true;
                break;
            }
        }
        if (po != null && redeploy == false) {
            po.updateDepoymentStage("Deploying");
            ow.println("Deploying");
            app = domain.createApplication(projectName, LatestVersionOf.jbossAs().get(user));
            List<IEmbeddedCartridge> ecs = app.getEmbeddedCartridges();
            for (IEmbeddedCartridge ec : ecs) {
                ow.println("Cartridge: " + ec.getName());
            }
            ow.println("Deployment Type: " + app.getDeploymentType());
            ow.println("Initial Git URL: " + app.getInitialGitUrl());
            ow.println("Git URL: " + app.getGitUrl());
            ow.println("SSH URL: " + app.getSshUrl());
            ow.println("Creation Log: " + app.getCreationLog());
        }
    }
}
