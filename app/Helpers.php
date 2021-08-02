<?php
class Helpers
{
    /**
     * set format Errors
     *
     * @param array $errors
     * @param string $format
     * @return string|array
     */
    public static function setErrors(array $errors, $format = "html")
    {
        $html = "<ul class='text-left font-sm list-inside list-decimal'>";
        $errorArray = [];
        foreach ($errors as $error) {
            $x = count($error);
            for ($i = 0; $i < $x; $i++) {
                $errorArray[] = $error[$i];
                $html .= "<li>{$error[$i]}</li>";
            }
        }
        $html .= "</ul>";
        return ($format == "html" ? $html : $errorArray);
    }
}
