<?php
namespace Codeception\Module;

class AcceptanceHelper extends \Codeception\Module
{
    public function typeExpression($expression)
    {
        $driver = $this->getModule('WebDriver');
        for ($i = 0; isset($expression[$i]); $i++) {
            $char = $expression[$i];
            if (strlen(trim($char)) === 0) {
                continue;
            }

            switch ($char) {
                case '+':
                    $btn = 'op-plus';
                    break;
                case '-':
                    $btn = 'op-minus';
                    break;
                case '*':
                    $btn = 'op-mult';
                    break;
                case '/':
                    $btn = 'op-div';
                    break;
                default:
                    $btn = 'number' . $char;
            }

            $driver->click('#btn-' . $btn);
        }
    }
}
