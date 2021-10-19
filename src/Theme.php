<?php

namespace Scaffold\Theme;

use \Scaffold\Essentials\Essentials;

use \Scaffold\Essentials\Services\{
    HookLoader,
    AssetLoader
};

use \Scaffold\Essentials\Contracts\CacheInterface;

class Theme 
{

    protected $theme;

    protected $container;

    protected $hooks;

    protected $assets;

    protected $cache;

    public function __construct( \WP_Theme $theme, Essentials $container ) 
    {

        $this->theme = $theme;

        $this->container = $container;

        $this->hooks = null;

        $this->assets = null;

        $this->cache = null;
    }

    public function container(): Essentials 
    {

        return $this->container;
    }

    public function hooks(): HookLoader
    {

        if ( $this->hooks === null ) {

            $this->hooks = $this->container->make(HookLoader::class);
        }

        return $this->hooks;
    }

    public function assets(): AssetLoader
    {

        if ( $this->assets === null ) {

            $this->assets = $this->container->make(AssetLoader::class);
        }

        return $this->assets;
    }

    public function cache(): CacheInterface
    {

        if ( $this->cache === null ) {

            $this->cache = $this->container->make(CacheInterface::class);
        }

        return $this->cache;
    }

    public function get( string $head ) 
    {

        return $this->theme->get( $head );
    }

    public function restBase(): string
    {
        
        $version = (int) $this->theme->get( 'Version' );

        $version = $version > 0 ? $version : 1;
        
        return $this->theme->get( 'TextDomain' ) . '/v' . $version;
    }

    public function publicPath( string $relpath = null ): string 
    {

        return $this->container->getPublicpath( $relpath );
    }

    public function basePath( string $relpath = null ): string 
    {

        return $this->container->getBasepath( $relpath );
    }
}