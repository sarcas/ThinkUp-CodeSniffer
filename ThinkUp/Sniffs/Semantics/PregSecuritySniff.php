<?php
/**
 * ThinkUp_Sniffs_Semantics_PregSecuritySniff.
 *
 * PHP version 5
 *
 * @category PHP
 * @package  PHP_CodeSniffer
 * @link     http://pear.php.net/package/PHP_CodeSniffer
 */

/**
 * Check the usage of the preg functions to ensure the insecure /e flag isn't
 * used: http://drupal.org/node/750148
 *
 * @category PHP
 * @package  PHP_CodeSniffer
 * @link     http://pear.php.net/package/PHP_CodeSniffer
 */
class ThinkUp_Sniffs_Semantics_PregSecuritySniff extends Drupal_Sniffs_Semantics_FunctionCall
{


    /**
     * Returns an array of function names this test wants to listen for.
     *
     * @return array
     */
    public function registerFunctionNames()
    {
        return array(
          'preg_filter',
          'preg_grep',
          'preg_match',
          'preg_match_all',
          'preg_replace',
          'preg_replace_callback',
          'preg_split',
        );

    }//end registerFunctionNames()


    /**
     * Processes this test, when one of its tokens is encountered.
     *
     * @param PHP_CodeSniffer_File $phpcsFile The file being scanned.
     * @param int                  $stackPtr  The position of the current token
     *                                        in the stack passed in $tokens.
     *
     * @return void
     */
    public function processFunctionCall(PHP_CodeSniffer_File $phpcsFile, $stackPtr)
    {
        $tokens   = $phpcsFile->getTokens();
        $argument = $this->getArgument(1);

        if ($argument === false) {
            return;
        }

        if ($tokens[$argument['start']]['code'] !== T_CONSTANT_ENCAPSED_STRING) {
            // Not a string literal.
            // @TODO: Extend code to recognize patterns in variables.
            return;
        }

        $pattern = $tokens[$argument['start']]['content'];
        $quote = substr($pattern, 0, 1);
        // Check that the pattern is a string.
        if ($quote == '"' || $quote == "'") {
            // Get the delimiter - first char after the enclosing quotes.
            $delimiter = preg_quote(substr($pattern, 1, 1), '/');
            // Check if there is the evil e flag.
            if (preg_match('/' . $delimiter . '[\w]{0,}e[\w]{0,}\b/', $pattern)) {
                $warn = 'Using the e flag in %s is a possible security risk. For details see http://drupal.org/node/750148';
                $phpcsFile->addError(
                    $warn,
                    $argument['start'],
                    'PregEFlag',
                    array($tokens[$stackPtr]['content'])
                );
                return;
            }
        }
    }//end processFunctionCall()


}//end class

?>
