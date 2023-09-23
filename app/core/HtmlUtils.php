<?php
namespace App\core;
class HtmlUtils
{
    /**
     * Escape special characters in a string to prevent XSS attacks.
     *
     * @param string $input The input string to escape.
     *
     * @return string The escaped string.
     */
    public static function escape($input)
    {
        return htmlspecialchars($input, ENT_QUOTES | ENT_HTML5, 'UTF-8');
    }

    /**
     * Escape an array of strings using htmlspecialchars.
     *
     * @param array $inputArray The array of input strings to escape.
     *
     * @return array The escaped array of strings.
     */
    public static function escapeArray(array $inputArray)
    {
        return array_map(['self', 'escape'], $inputArray);
    }

    /**
     * Escape a multidimensional array of strings using htmlspecialchars.
     *
     * @param array $inputArray The multidimensional array of input strings to escape.
     *
     * @return array The escaped multidimensional array of strings.
     */
    public static function escapeMultiDimensionalArray(array $inputArray)
    {
        return array_map(['self', 'escapeArray'], $inputArray);
    }

    // keep the input values
    public static function getInputValue($name, $value = null)
    {
        if (isset($_POST[$name])) {
            $selectedValue = $_POST[$name];
            if ($value !== null && $selectedValue === $value) {
                return 'selected';
            }
            echo htmlspecialchars($selectedValue);
        }
        return false;
    }

    
}
