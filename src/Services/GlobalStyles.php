<?php

namespace Scaffold\Theme\Services;

use Scaffold\Theme\Options\ThemeOption;

class GlobalStyles
{

    protected $option;

    public function __construct(ThemeOption $options)
    {

        $this->option = $options;
    }

    public function getCustomProperties()
    {

        $styles = array_merge(
            $this->option->getGroup('color'),
            $this->option->getGroup('font'),
            $this->option->getGroup('media')
        );

        $root = array_reduce(
            array_keys($styles),
            function ($acc, $curr) use ($styles) {

                if (is_array($path = explode('.', $curr))) {
                    if (absint($styles[$curr])) {
                        $value = 'font' === $path[0]
                        ? $styles[$curr] . ( ! $this->option->get('px-or-rem-unit') ? 'px' : 'rem' )
                        : $styles[$curr] . 'px';
                    } else {
                        // Find color hex
                        if (strpos($styles[$curr], '#') !== false) {
                            // make rgb value
                            list( $r, $g, $b ) = sscanf($styles[$curr], "#%02x%02x%02x");

                            $acc .= "--theme-$path[1]-rgb: $r,$g,$b; \n";
                        }

                        $value = $styles[$curr];
                    }

                    $acc .= "--theme-$path[1]-$path[0]: $value; \n";
                }

                return $acc;
            },
            ''
        );

        return ":root{\n$root}";
    }
}
