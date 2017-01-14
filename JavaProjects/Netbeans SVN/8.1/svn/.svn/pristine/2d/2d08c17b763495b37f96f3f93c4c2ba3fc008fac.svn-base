package org.netbeans.cheats.extensions;
import org.netbeans.cheats.api.CodeTemplateFileProcessor;
import org.openide.filesystems.FileObject;
import org.openide.filesystems.FileUtil;
import org.openide.util.lookup.ServiceProvider;
@ServiceProvider(service = CodeTemplateFileProcessor.class)
public class PHPCodeTemplateFileProcessor implements CodeTemplateFileProcessor {
    @Override
    public FileObject getInternalFile() {
        return FileUtil.getConfigFile("Editors/text/x-php5/CodeTemplates/Defaults/org-netbeans-modules-php-editor-codetemplates.xml");
    }
    @Override
    public FileObject getFolderContainingCustomizableFile() {
        return FileUtil.getConfigFile("Editors/text/x-php5/CodeTemplates");
    }
    @Override
    public String toString() {
        return "PHP";
    }
}
