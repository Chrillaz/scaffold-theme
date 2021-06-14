<?php

namespace Scaffold\Theme\Hooks;

use Scaffold\Essentials\Abstracts\Hooks;
use Scaffold\Theme\Options\ThemeOption;
use Scaffold\Essentials\Services\HookLoader;

final class OptionPage extends Hooks
{

    protected $hooks;

    protected $options;

    public function __construct(HookLoader $hooks, ThemeOption $options)
    {

        $this->hooks = $hooks;

        $this->options = $options;
    }

    public function adminInit()
    {

        \register_setting($this->options->getName(), $this->options->getName());
    }

    public function adminMenu()
    {

        \add_theme_page(
            __('Theme Options', Theme()->get('TextDomain')),
            __('Theme Options', Theme()->get('TextDomain')),
            $this->options->getCapability(),
            $this->options->getName(),
            function () {
                \get_template_part(
                    'templates/admin/options',
                    'page',
                    [
                    Theme(),
                    $this->options
                    ]
                );
            },
            null
        );
    }

    public function register(): void
    {

        $this->hooks->addAction('admin_menu', 'adminMenu', $this);

        $this->hooks->addAction('admin_init', 'adminInit', $this);

        $this->hooks->load();
    }
}
