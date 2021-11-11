<?php

namespace code\utility;

use Laminas\Escaper\Escaper;

class Escaper {

    private $escaper;

    public function __construct() {
        $this->escaper = new Escaper('utf-8');
    }

    /**
     * 
     * @param string $input
     * @return string
     */
    public function escapeHTML(string $input): string {
        return $this->escaper->escapeHtml($input);
    }

    /**
     * 
     * @param string $input
     * @return string
     */
    public function escapeHtmlAttr(string $input): string {
        return $this->escaper->escapeHtmlAttr($input);
    }

    /**
     * 
     * @param array $values
     * @return array
     */
    public function escapeArrayHTML(array $values): array {

        foreach ($values as $value) {
            $value = $this->escapeHTML($value);
        }
        return $values;
    }

}
