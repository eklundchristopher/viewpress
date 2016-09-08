<?php

namespace EklundChristopher\ViewPress;

use Illuminate\View\Compilers\BladeCompiler as Compiler;

class BladeCompiler extends Compiler
{
    /**
     * Compile the given Blade template contents.
     *
     * @param  string  $value
     * @return string
     */
    public function compileString($value)
    {
        $content = parent::compileString($value);

        return trim($content).PHP_EOL.'<?php exit; ?>';
    }
}
