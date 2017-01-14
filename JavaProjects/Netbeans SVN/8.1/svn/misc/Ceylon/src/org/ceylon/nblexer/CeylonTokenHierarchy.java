/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
package org.ceylon.nblexer;
import com.redhat.ceylon.compiler.typechecker.parser.CeylonLexer;
import java.util.*;
import org.netbeans.spi.lexer.LanguageHierarchy;
import org.netbeans.spi.lexer.Lexer;
import org.netbeans.spi.lexer.LexerRestartInfo;
/**
 *
 * @author geertjan
 */
public class CeylonTokenHierarchy extends LanguageHierarchy<CeylonTokenId> {
    private static List<CeylonTokenId> tokens;
    private static Map<Integer, CeylonTokenId> idToToken;
    private static void init() {
        tokens = Arrays.<CeylonTokenId>asList(new CeylonTokenId[]{ //            new CeylonTokenId("ABSTRACTED_TYPE", "foo", CeylonLexer.ABSTRACTED_TYPE),
            new CeylonTokenId("ADD_SPECIFY", "foo", CeylonLexer.ADD_SPECIFY),
            new CeylonTokenId("AIDENTIFIER", "annotationAttribute", CeylonLexer.AIDENTIFIER),
            new CeylonTokenId("ALIAS", "foo", CeylonLexer.ALIAS),
            new CeylonTokenId("AND_OP", "foo", CeylonLexer.AND_OP),
            new CeylonTokenId("AND_SPECIFY", "foo", CeylonLexer.AND_SPECIFY),
            new CeylonTokenId("ASSEMBLY", "foo", CeylonLexer.ASSEMBLY),
            new CeylonTokenId("ASSERT", "foo", CeylonLexer.ASSERT),
            new CeylonTokenId("ASSIGN", "foo", CeylonLexer.ASSIGN),
            new CeylonTokenId("ASTRING_LITERAL", "annotationStringAttribute", CeylonLexer.ASTRING_LITERAL),
            new CeylonTokenId("AVERBATIM_STRING", "annotationStringAttribute", CeylonLexer.AVERBATIM_STRING),
            new CeylonTokenId("BACKTICK", "typeLiteralAttribute", CeylonLexer.BACKTICK),
            new CeylonTokenId("BREAK", "foo", CeylonLexer.BREAK),
            new CeylonTokenId("BinaryDigit", "foo", CeylonLexer.BinaryDigit),
            new CeylonTokenId("BinaryDigits", "foo", CeylonLexer.BinaryDigits),
            new CeylonTokenId("CASE_CLAUSE", "foo", CeylonLexer.CASE_CLAUSE),
            new CeylonTokenId("CASE_TYPES", "foo", CeylonLexer.CASE_TYPES),
            new CeylonTokenId("CATCH_CLAUSE", "foo", CeylonLexer.CATCH_CLAUSE),
            new CeylonTokenId("CHAR_LITERAL", "charAttribute", CeylonLexer.CHAR_LITERAL),
            new CeylonTokenId("CLASS_DEFINITION", "foo", CeylonLexer.CLASS_DEFINITION),
            new CeylonTokenId("COMMA", "foo", CeylonLexer.COMMA),
            new CeylonTokenId("COMPARE_OP", "foo", CeylonLexer.COMPARE_OP),
            new CeylonTokenId("COMPILER_ANNOTATION", "foo", CeylonLexer.COMPILER_ANNOTATION),
            new CeylonTokenId("COMPLEMENT_OP", "foo", CeylonLexer.COMPLEMENT_OP),
            new CeylonTokenId("COMPLEMENT_SPECIFY", "foo", CeylonLexer.COMPLEMENT_SPECIFY),
            new CeylonTokenId("COMPUTE", "foo", CeylonLexer.COMPUTE),
            new CeylonTokenId("CONTINUE", "foo", CeylonLexer.CONTINUE),
            new CeylonTokenId("CharPart", "foo", CeylonLexer.CharPart),
            new CeylonTokenId("DECREMENT_OP", "foo", CeylonLexer.DECREMENT_OP),
            new CeylonTokenId("DIFFERENCE_OP", "foo", CeylonLexer.DIFFERENCE_OP),
            new CeylonTokenId("DIVIDE_SPECIFY", "foo", CeylonLexer.DIVIDE_SPECIFY),
            new CeylonTokenId("DYNAMIC", "foo", CeylonLexer.DYNAMIC),
            new CeylonTokenId("Digit", "foo", CeylonLexer.Digit),
            new CeylonTokenId("Digits", "foo", CeylonLexer.Digits),
            new CeylonTokenId("ELLIPSIS", "foo", CeylonLexer.ELLIPSIS),
            new CeylonTokenId("ELSE_CLAUSE", "foo", CeylonLexer.ELSE_CLAUSE),
            new CeylonTokenId("ENTRY_OP", "foo", CeylonLexer.ENTRY_OP),
            new CeylonTokenId("EQUAL_OP", "foo", CeylonLexer.EQUAL_OP),
            new CeylonTokenId("EXISTS", "foo", CeylonLexer.EXISTS),
            new CeylonTokenId("EXTENDS", "foo", CeylonLexer.EXTENDS),
            new CeylonTokenId("EscapeSequence", "foo", CeylonLexer.EscapeSequence),
            new CeylonTokenId("Exponent", "foo", CeylonLexer.Exponent),
            new CeylonTokenId("FINALLY_CLAUSE", "foo", CeylonLexer.FINALLY_CLAUSE),
            new CeylonTokenId("FLOAT_LITERAL", "numberAttribute", CeylonLexer.FLOAT_LITERAL),
            new CeylonTokenId("FOR_CLAUSE", "foo", CeylonLexer.FOR_CLAUSE),
            new CeylonTokenId("FUNCTION_MODIFIER", "foo", CeylonLexer.FUNCTION_MODIFIER),
            new CeylonTokenId("FractionalMagnitude", "foo", CeylonLexer.FractionalMagnitude),
            new CeylonTokenId("IDENTICAL_OP", "foo", CeylonLexer.IDENTICAL_OP),
            new CeylonTokenId("IF_CLAUSE", "foo", CeylonLexer.IF_CLAUSE),
            new CeylonTokenId("IMPORT", "foo", CeylonLexer.IMPORT),
            new CeylonTokenId("INCREMENT_OP", "foo", CeylonLexer.INCREMENT_OP),
            new CeylonTokenId("INTERFACE_DEFINITION", "foo", CeylonLexer.INTERFACE_DEFINITION),
            new CeylonTokenId("INTERSECTION_OP", "foo", CeylonLexer.INTERSECTION_OP),
            new CeylonTokenId("INTERSECT_SPECIFY", "foo", CeylonLexer.INTERSECT_SPECIFY),
            new CeylonTokenId("IN_OP", "foo", CeylonLexer.IN_OP),
            new CeylonTokenId("IS_OP", "foo", CeylonLexer.IS_OP),
            new CeylonTokenId("IdentifierPart", "foo", CeylonLexer.IdentifierPart),
            new CeylonTokenId("IdentifierStart", "foo", CeylonLexer.IdentifierStart),
            new CeylonTokenId("LARGER_OP", "foo", CeylonLexer.LARGER_OP),
            new CeylonTokenId("LARGE_AS_OP", "foo", CeylonLexer.LARGE_AS_OP),
            new CeylonTokenId("LBRACE", "braceAttribute", CeylonLexer.LBRACE),
            new CeylonTokenId("LBRACKET", "foo", CeylonLexer.LBRACKET),
            new CeylonTokenId("LET", "foo", CeylonLexer.LET),
            new CeylonTokenId("LIDENTIFIER", "identifierAttribute", CeylonLexer.LIDENTIFIER),
            new CeylonTokenId("LINE_COMMENT", "comment", CeylonLexer.LINE_COMMENT),
            new CeylonTokenId("LIdentifierPrefix", "identifierAttribute", CeylonLexer.LIdentifierPrefix),
            new CeylonTokenId("LPAREN", "foo", CeylonLexer.LPAREN),
            new CeylonTokenId("Letter", "foo", CeylonLexer.Letter),
            new CeylonTokenId("MEMBER_OP", "foo", CeylonLexer.MEMBER_OP),
            new CeylonTokenId("MODULE", "foo", CeylonLexer.MODULE),
            new CeylonTokenId("MULTIPLY_SPECIFY", "foo", CeylonLexer.MULTIPLY_SPECIFY),
            new CeylonTokenId("MULTI_COMMENT", "comment", CeylonLexer.MULTI_COMMENT),
            new CeylonTokenId("Magnitude", "foo", CeylonLexer.Magnitude),
            new CeylonTokenId("NATURAL_LITERAL", "numberAttribute", CeylonLexer.NATURAL_LITERAL),
            new CeylonTokenId("NEW", "numberAttribute", CeylonLexer.NEW),
            new CeylonTokenId("NONEMPTY", "foo", CeylonLexer.NONEMPTY),
            new CeylonTokenId("NOT_EQUAL_OP", "foo", CeylonLexer.NOT_EQUAL_OP),
            new CeylonTokenId("NOT_OP", "foo", CeylonLexer.NOT_OP),
            new CeylonTokenId("OBJECT_DEFINITION", "foo", CeylonLexer.OBJECT_DEFINITION),
            new CeylonTokenId("OPTIONAL", "foo", CeylonLexer.OPTIONAL),
            new CeylonTokenId("OR_OP", "foo", CeylonLexer.OR_OP),
            new CeylonTokenId("OR_SPECIFY", "foo", CeylonLexer.OR_SPECIFY),
            new CeylonTokenId("OUT", "foo", CeylonLexer.OUT),
            new CeylonTokenId("OUTER", "foo", CeylonLexer.OUTER),
            new CeylonTokenId("PACKAGE", "packageAttribute", CeylonLexer.PACKAGE),
            new CeylonTokenId("PIDENTIFIER", "packageAttribute", CeylonLexer.PIDENTIFIER),
            new CeylonTokenId("POWER_OP", "foo", CeylonLexer.POWER_OP),
            new CeylonTokenId("PRODUCT_OP", "foo", CeylonLexer.PRODUCT_OP),
            new CeylonTokenId("QUOTIENT_OP", "foo", CeylonLexer.QUOTIENT_OP),
            new CeylonTokenId("RANGE_OP", "foo", CeylonLexer.RANGE_OP),
            new CeylonTokenId("RBRACE", "braceAttribute", CeylonLexer.RBRACE),
            new CeylonTokenId("RBRACKET", "foo", CeylonLexer.RBRACKET),
            new CeylonTokenId("REMAINDER_OP", "foo", CeylonLexer.REMAINDER_OP),
            new CeylonTokenId("REMAINDER_SPECIFY", "foo", CeylonLexer.REMAINDER_SPECIFY),
            new CeylonTokenId("RETURN", "foo", CeylonLexer.RETURN),
            new CeylonTokenId("RPAREN", "foo", CeylonLexer.RPAREN),
            new CeylonTokenId("SAFE_MEMBER_OP", "foo", CeylonLexer.SAFE_MEMBER_OP),
            new CeylonTokenId("SATISFIES", "foo", CeylonLexer.SATISFIES),
            new CeylonTokenId("SCALE_OP", "foo", CeylonLexer.SCALE_OP),
            new CeylonTokenId("SEGMENT_OP", "semiAttribute", CeylonLexer.SEGMENT_OP),
            new CeylonTokenId("SEMICOLON", "semiAttribute", CeylonLexer.SEMICOLON),
            new CeylonTokenId("SMALLER_OP", "foo", CeylonLexer.SMALLER_OP),
            new CeylonTokenId("SMALL_AS_OP", "foo", CeylonLexer.SMALL_AS_OP),
            new CeylonTokenId("SPECIFY", "foo", CeylonLexer.SPECIFY),
            new CeylonTokenId("SPREAD_OP", "foo", CeylonLexer.SPREAD_OP),
            new CeylonTokenId("STRING_END", "stringAttribute", CeylonLexer.STRING_END),
            new CeylonTokenId("STRING_LITERAL", "stringAttribute", CeylonLexer.STRING_LITERAL),
            new CeylonTokenId("STRING_MID", "stringAttribute", CeylonLexer.STRING_MID),
            new CeylonTokenId("STRING_START", "stringAttribute", CeylonLexer.STRING_START),
            new CeylonTokenId("SUBTRACT_SPECIFY", "foo", CeylonLexer.SUBTRACT_SPECIFY),
            new CeylonTokenId("SUM_OP", "foo", CeylonLexer.SUM_OP),
            new CeylonTokenId("SUPER", "foo", CeylonLexer.SUPER),
            new CeylonTokenId("SWITCH_CLAUSE", "foo", CeylonLexer.SWITCH_CLAUSE),
            new CeylonTokenId("StringPart", "foo", CeylonLexer.StringPart),
            new CeylonTokenId("THEN_CLAUSE", "foo", CeylonLexer.THEN_CLAUSE),
            new CeylonTokenId("THIS", "foo", CeylonLexer.THIS),
            new CeylonTokenId("THROW", "foo", CeylonLexer.THROW),
            new CeylonTokenId("TRY_CLAUSE", "foo", CeylonLexer.TRY_CLAUSE),
            new CeylonTokenId("TYPE_CONSTRAINT", "foo", CeylonLexer.TYPE_CONSTRAINT),
            new CeylonTokenId("UIDENTIFIER", "typeAttribute", CeylonLexer.UIDENTIFIER),
            new CeylonTokenId("UIdentifierPrefix", "foo", CeylonLexer.UIdentifierPrefix),
            new CeylonTokenId("UNION_OP", "foo", CeylonLexer.UNION_OP),
            new CeylonTokenId("UNION_SPECIFY", "foo", CeylonLexer.UNION_SPECIFY),
            new CeylonTokenId("VALUE_MODIFIER", "foo", CeylonLexer.VALUE_MODIFIER),
            new CeylonTokenId("VERBATIM_STRING", "stringAttribute", CeylonLexer.VERBATIM_STRING),
            new CeylonTokenId("VOID_MODIFIER", "foo", CeylonLexer.VOID_MODIFIER),
            new CeylonTokenId("WHILE_CLAUSE", "foo", CeylonLexer.WHILE_CLAUSE),
            new CeylonTokenId("WS", "whitespace", CeylonLexer.WS)
        //            new CeylonTokenId("XOR_ASSIGN_OP", "foo", 121),
        //            new CeylonTokenId("XOR_OP", "foo", 122)
        });
        idToToken = new HashMap<Integer, CeylonTokenId>();
        for (CeylonTokenId token : tokens) {
            idToToken.put(token.ordinal(), token);
        }
    }
    static synchronized CeylonTokenId getToken(int id) {
        if (idToToken == null) {
            init();
        }
        return idToToken.get(id);
    }
    @Override
    protected synchronized Collection<CeylonTokenId> createTokenIds() {
        if (tokens == null) {
            init();
        }
        return tokens;
    }
    @Override
    protected synchronized Lexer<CeylonTokenId> createLexer(LexerRestartInfo<CeylonTokenId> info) {
        return new NBCeylonLexer(info);
    }
    @Override
    protected String mimeType() {
        return "text/x-ceylon";
    }
}
