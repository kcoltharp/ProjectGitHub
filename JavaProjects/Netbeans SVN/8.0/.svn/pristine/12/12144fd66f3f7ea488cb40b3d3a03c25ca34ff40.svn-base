package org.netbeans.lnb;

import java.io.File;
import org.netbeans.api.extexecution.ExecutionDescriptor;
import org.netbeans.api.extexecution.ExecutionService;
import org.netbeans.api.extexecution.ExternalProcessBuilder;

public class LNBUtils {

    public static void command(String name) {
        ExecutionDescriptor executionDescriptor = new ExecutionDescriptor().
                frontWindow(true).
                controllable(true).
                showProgress(true);
        File userdir = new File(System.getProperty("netbeans.user"));
        ExternalProcessBuilder externalProcessBuilder = new ExternalProcessBuilder("lazybones").
                workingDirectory(userdir).
                addArgument("create").
                addArgument("ratpack-lite").
                addArgument(name);
        ExecutionService service = ExecutionService.newService(
                externalProcessBuilder, 
                executionDescriptor, 
                "lazybones create ratpack-lite" + name
        );
        service.run();
    }

}
