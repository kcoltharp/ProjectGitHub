package org.netbeans.modules.cloud.foo.utils;
import com.openshift.client.IApplication;
import com.openshift.client.IDomain;
import com.openshift.client.IOpenShiftConnection;
import com.openshift.client.IUser;
import com.openshift.client.OpenShiftConnectionFactory;
import java.awt.Image;
import java.awt.event.ActionEvent;
import java.beans.IntrospectionException;
import java.net.URL;
import java.util.List;
import javax.swing.AbstractAction;
import javax.swing.Action;
import org.netbeans.modules.j2ee.deployment.plugins.api.UISupport;
import org.openide.awt.HtmlBrowser;
import org.openide.nodes.BeanNode;
import org.openide.nodes.ChildFactory;
import org.openide.nodes.Node;
import org.openide.util.Exceptions;
import org.netbeans.modules.web.common.api.WebUtils;
import org.openide.util.ImageUtilities;
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
        for (IDomain domain : user.getDomains()) {
            list.addAll(domain.getApplications());
        }
        return true;
    }
    @Override
    protected Node createNodeForKey(final IApplication key) {
        BeanNode<IApplication> applicationNode = null;
        try {
            applicationNode = new BeanNode<IApplication>(key) {
                @Override
                public Action[] getActions(boolean context) {
                    return new Action[]{
                        new AbstractAction("View") {
                            @Override
                            public void actionPerformed(ActionEvent e) {
                                String appURL = key.getApplicationUrl();
                                URL url = WebUtils.stringToUrl(appURL);
                                HtmlBrowser.URLDisplayer.getDefault().showURL(url);
                            }
                        },
                        new AbstractAction("Start") {
                            @Override
                            public void actionPerformed(ActionEvent e) {
                                throw new UnsupportedOperationException("Start is not supported yet."); // NOI18N
                            }
                        },
                        new AbstractAction("Stop") {
                            @Override
                            public void actionPerformed(ActionEvent e) {
                                throw new UnsupportedOperationException("Stop is not supported yet."); // NOI18N
                            }
                        },
                        new AbstractAction("Undeploy") {
                            @Override
                            public void actionPerformed(ActionEvent e) {
                                throw new UnsupportedOperationException("Undeploy is not supported yet."); // NOI18N
                            }
                        }};
                }
                @Override
                public Image getIcon(int type) {
                    return badgeIcon(UISupport.getIcon(UISupport.ServerIcon.WAR_ARCHIVE));
                }
                @Override
                public Image getOpenedIcon(int type) {
                    return badgeIcon(UISupport.getIcon(UISupport.ServerIcon.WAR_ARCHIVE));
                }
                private Image badgeIcon(Image origImg) {
                    Image badge = null;
                    return badge != null ? ImageUtilities.mergeImages(origImg, badge, 15, 8) : origImg;
                }
            };
            applicationNode.setDisplayName(key.getName());
        } catch (IntrospectionException ex) {
            Exceptions.printStackTrace(ex);
        }
        return applicationNode;
    }
}
