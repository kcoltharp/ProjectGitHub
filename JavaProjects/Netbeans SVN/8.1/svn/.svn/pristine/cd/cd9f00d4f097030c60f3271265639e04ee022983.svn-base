package org.netbeans.cheats.extensions;
import org.netbeans.cheats.api.CodeTemplateFileProcessor;
import org.openide.filesystems.FileObject;
import org.openide.filesystems.FileUtil;
import org.openide.util.lookup.ServiceProvider;
@ServiceProvider(service = CodeTemplateFileProcessor.class)
public class XMLCodeTemplateFileProcessor implements CodeTemplateFileProcessor {
    @Override
    public FileObject getInternalFile() {
        return FileUtil.getConfigFile("Editors/text/xml/CodeTemplates/Defaults/org-netbeans-modules-xml-text-xmlCodeTemplates.xml");
    }
    @Override
    public FileObject getFolderContainingCustomizableFile() {
        return FileUtil.getConfigFile("Editors/text/xml/CodeTemplates");
    }
    @Override
    public String toString() {
        return "XML";
    }
}
