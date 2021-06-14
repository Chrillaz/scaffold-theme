<?php

namespace Scaffold\Theme;

use Scaffold\Essentials\Essentials;

class Theme
{

    protected $theme;

    protected $container;

    public function __construct(\WP_Theme $theme, Essentials $container)
    {

        $this->theme = $theme;

        $this->container = $container;
    }

    public function container()
    {

        return $this->container;
    }

    public function get(string $head)
    {

        return $this->theme->get($head);
    }

    public function publicPath(string $relpath = null): string
    {

        return $this->container->getPublicpath($relpath);
    }

    public function basePath(string $relpath = null): string
    {

        return $this->container->getBasepath($relpath);
    }
}
