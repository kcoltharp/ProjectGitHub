package org.ceylon.features;
import com.redhat.ceylon.compiler.typechecker.parser.ParseError;
import java.util.ArrayList;
import java.util.Collections;
import java.util.List;
import javax.swing.JOptionPane;
import javax.swing.text.BadLocationException;
import javax.swing.text.Document;
import javax.swing.text.StyledDocument;
import org.ceylon.nbparser.NBCeylonParser.CeylonParserResult;
import org.netbeans.modules.parsing.spi.Parser.Result;
import org.netbeans.modules.parsing.spi.ParserResultTask;
import org.netbeans.modules.parsing.spi.Scheduler;
import org.netbeans.modules.parsing.spi.SchedulerEvent;
import org.netbeans.spi.editor.hints.ErrorDescription;
import org.netbeans.spi.editor.hints.ErrorDescriptionFactory;
import org.netbeans.spi.editor.hints.HintsController;
import org.netbeans.spi.editor.hints.Severity;
import org.openide.text.NbDocument;
import org.openide.util.Exceptions;
public class CeylonSyntaxErrorHighlightingTask extends ParserResultTask {
    @Override
    public void run(Result result, SchedulerEvent event) {
        try {
            CeylonParserResult sjResult = (CeylonParserResult) result;
            List<ParseError> syntaxErrors = sjResult.getCeylonParser().getErrors();
//            JOptionPane.showMessageDialog(null, syntaxErrors.size());
            Document document = result.getSnapshot().getSource().getDocument(false);
            List<ErrorDescription> errors = new ArrayList<ErrorDescription>();
            for (ParseError syntaxError : syntaxErrors) {
                int beginLine = syntaxError.getLine();
//                System.out.println("beginLine = " + beginLine);
                int endLine = syntaxError.getCharacterInLine();
//                System.out.println("endLine = " + endLine);
                int start1 = NbDocument.findLineOffset((StyledDocument) document, beginLine);
//                System.out.println("start1 = " + start1);
                int start2 = NbDocument.findLineNumber((StyledDocument) document, beginLine);
//                System.out.println("start2 = " + start2);
//                int end = NbDocument.findLineOffset((StyledDocument) document, endLine);
//                System.out.println("end = " + end);
                ErrorDescription errorDescription
                        = ErrorDescriptionFactory.createErrorDescription(
                                Severity.ERROR,
                                syntaxError.getMessage(),
                                Collections.EMPTY_LIST,
                                document,
                                beginLine
                        );
                errors.add(errorDescription);
            }
            HintsController.setErrors(document, "simple-java", errors);
        } catch (org.netbeans.modules.parsing.spi.ParseException ex1) {
            Exceptions.printStackTrace(ex1);
        }
    }
    @Override
    public int getPriority() {
        return 100;
    }
    @Override
    public Class getSchedulerClass() {
        return Scheduler.EDITOR_SENSITIVE_TASK_SCHEDULER;
    }
    @Override
    public void cancel() {
    }
}
