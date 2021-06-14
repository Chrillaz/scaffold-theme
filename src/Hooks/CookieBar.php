<?php

namespace Scaffold\Theme\Hooks;

use Scaffold\Theme\Options\CookieOption;
use Scaffold\Essentials\Abstracts\Hooks;
use Scaffold\Essentials\Services\HookLoader;

final class CookieBar extends Hooks
{

    protected $hooks;

    protected $options;

    public function __construct(HookLoader $hooks, CookieOption $options)
    {

        $this->hooks = $hooks;

        $this->options = $options;
    }

    public function adminMenu()
    {

        \add_options_page(
            __('Cookies', Theme()->get('TextDomain')),
            __('Cookies', Theme()->get('TextDomain')),
            $this->options->getCapability(),
            $this->options->getName(),
            [$this, 'pageContent'],
            null
        );
    }

    public function adminInit()
    {

        \register_setting($this->options->getName(), $this->options->getName());

        \add_settings_section(
            $this->options->getName() . 'section1',
            '',
            [ $this, 'generalSection' ],
            $this->options->getName()
        );

        \add_settings_section(
            $this->options->getName() . 'section2',
            'Contents settings',
            [ $this, 'contentsSection' ],
            $this->options->getName()
        );

        \add_settings_field(
            $this->options->getName() . 'activate',
            __('Activate', Theme()->get('TextDomain')),
            [ $this, 'activationField' ],
            $this->options->getName(),
            $this->options->getName() . 'section1'
        );

        \add_settings_field(
            $this->options->getName() . 'timeout',
            __('Timeout', Theme()->get('TextDomain')),
            [ $this, 'timeoutField' ],
            $this->options->getName(),
            $this->options->getName() . 'section1'
        );

        \add_settings_field(
            $this->options->getName() . 'accept_content',
            __('Accept Content', Theme()->get('TextDomain')),
            [ $this, 'acceptField' ],
            $this->options->getName(),
            $this->options->getName() . 'section1'
        );
    }

    public function generalSection()
    {

        echo '<p>Settings for cookiebar acceptance.</p>';
    }

    public function contentsSection()
    {

        \wp_editor(
            \esc_html(__($this->options->get('content'), Theme()->get('TextDomain'))),
            'cookieEditor',
            [
            'tinymce'       => true,
            'textarea_name' => $this->options->getName() . '[content]',
            'textarea_rows' => 5,
            'tabindex'      => 1,
            'media_buttons' => false,
            'quicktags' => true,
            'tinymce'   => true
            ]
        );
    }

    public function activationField()
    {

        echo sprintf(
            '<label class="switch">
                <input id="theme-block-styles" name="%s" type="checkbox" value="1" %s />
                <span class="slider round"></span>
            </label>',
            $this->options->getName() . '[activate]',
            ( '1' === $this->options->get('activate') ? 'checked' : '' )
        );
    }

    public function timeoutField()
    {

        echo sprintf(
            '<input id="cookie-btn" name="%s" type="number" value="%s" />',
            $this->options->getName() . '[timeout]',
            \esc_html($this->options->get('timeout'), Theme()->get('TextDomain'))
        );
    }

    public function acceptField()
    {

        echo sprintf(
            '<input id="cookie-btn" name="%s" type="text" value="%s" />',
            $this->options->getName() . '[accept_content]',
            \esc_html($this->options->get('accept_content'), Theme()->get('TextDomain'))
        );
    }

    public function pageContent()
    {
        ?>
            <div class="wrap">
                <form method="post" action="options.php">
                <h2>Cookie Settings</h2>
                <?php
                    \settings_fields($this->options->getName());
                    \do_settings_sections($this->options->getName());
                    \submit_button();
                ?>
                </form>
            </div>
        <?php
    }

    public function output()
    {

        if ('1' !== $this->options->get('activate')) {
            return;
        }

        echo sprintf(
            '<div class="cookie" data-visible="false" data-delay="%s">
                <div class="cookie-wrapper">
                <small class="cookie-text">%s</small>
                <div class="wp-block-button">
                    <a class="wp-block-button__link cookie-accept" rel="nofollow">%s</a>
                </div>
                </div>
            </div>',
            $this->options->get('timeout'),
            $this->options->get('content'),
            $this->options->get('accept_content')
        );
    }

    public function register(): void
    {

        $this->hooks->addAction('admin_menu', 'adminMenu', $this);

        $this->hooks->addAction('admin_init', 'adminInit', $this);

        $this->hooks->addAction('wp_footer', 'output', $this);

        $this->hooks->load();
    }
}