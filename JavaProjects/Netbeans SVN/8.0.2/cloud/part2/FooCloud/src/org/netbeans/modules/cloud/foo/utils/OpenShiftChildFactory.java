package org.netbeans.modules.cloud.foo.utils;
import com.openshift.client.IApplication;
import com.openshift.client.IDomain;
import com.openshift.client.IOpenShiftConnection;
import com.openshift.client.IUser;
import com.openshift.client.OpenShiftConnectionFactory;
import java.util.List;
import org.openide.nodes.AbstractNode;
import org.openide.nodes.ChildFactory;
import org.openide.nodes.Children;
import org.openide.nodes.Node;
public class OpenShiftChildFactory extends ChildFactory<IApplication> {
    private final String username;
    private final String password;
    public OpenShiftChildFactory(String username, String password) {
        this.username = username;
        this.password = password;
    }
    @Override
    protected boolean createKeys(List<IApplication> list) {
        IOpenShiftConnection connection
                = new OpenShiftConnectionFactory().getConnection(
                        "netbeans",
                        username,
                        password);
        IUser user = connection.getUser();
        for(IDomain domain : user.getDomains()){
            list.addAll(domain.getApplications());
        }
        return true;
    }
    @Override
    protected Node createNodeForKey(IApplication key) {
        AbstractNode applicationNode = new AbstractNode(Children.LEAF);
        applicationNode.setDisplayName(key.getName());
        return applicationNode;
    }
}
