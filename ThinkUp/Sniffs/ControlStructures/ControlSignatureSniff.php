<?php
/**
 * Verifies that control statements conform to their coding standards.
 *
 * PHP version 5
 *
 * @category  PHP
 * @package   PHP_CodeSniffer
 * @author    Greg Sherwood <gsherwood@squiz.net>
 * @author    Marc McIntyre <mmcintyre@squiz.net>
 * @copyright 2006 Squiz Pty Ltd (ABN 77 084 670 600)
 * @license   http://matrix.squiz.net/developer/tools/php_cs/licence BSD Licence
 * @link      http://pear.php.net/package/PHP_CodeSniffer
 */

if (class_exists('PHP_CodeSniffer_Standards_AbstractPatternSniff', true) === false) {
    throw new PHP_CodeSniffer_Exception('Class PHP_CodeSniffer_Standards_AbstractPatternSniff not found');
}

/**
 * Verifies that control statements conform to their coding standards.
 *
 * @category  PHP
 * @package   PHP_CodeSniffer
 * @author    Greg Sherwood <gsherwood@squiz.net>
 * @author    Marc McIntyre <mmcintyre@squiz.net>
 * @copyright 2006 Squiz Pty Ltd (ABN 77 084 670 600)
 * @license   http://matrix.squiz.net/developer/tools/php_cs/licence BSD Licence
 * @version   Release: 1.2.0RC3
 * @link      http://pear.php.net/package/PHP_CodeSniffer
 */
class ThinkUp_Sniffs_ControlStructures_ControlSignatureSniff extends PHP_CodeSniffer_Standards_AbstractPatternSniff
{


    /**
     * Constructs a PEAR_Sniffs_ControlStructures_ControlSignatureSniff.
     */
    public function __construct()
    {
        parent::__construct(true);

    }//end __construct()


    /**
     * Returns the patterns that this test wishes to verify.
     *
     * @return array(string)
     */
    protected function getPatterns()
    {
        return array(
                'do {EOL...} while (...);EOL',
                'while (...) {EOL',
                'switch (...) {EOL',
                'for (...) {EOL',
                'if (...) {EOL',
                'foreach (...) {EOL',
                // The EOL preceding the else/elseif keywords is not detected
                // correctly, so we have
                // ThinkUp_Sniffs_ControlStructures_ElseNewlineSniff to
                // cover that.
                'elseif (...) {EOL',
                'else {EOL',
                'do {EOL',
               );

    }//end getPatterns()


}//end class

?>
