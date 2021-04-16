<?php

use PHPUnit\Framework\TestCase;

use WpTheme\Scaffold\Framework\Resources\Storage;

use WpTheme\Scaffold\Framework\Container\Container;

class ContainerTest extends TestCase {

  private $container;

  protected function setUp (): void {

    $definitions = new Storage();

    $definitions->set( 'HookLoader', 'WpTheme\\Scaffold\\Framework\\Services\\HookLoader'::class );
    $definitions->set( 'AssetLoader', 'WpTheme\\Scaffold\\Framework\\Services\\AssetLoader'::class );
    $definitions->set( 'ScriptLoaderProvider', 'WpTheme\\Scaffold\\App\\Providers\\ScriptLoaderProvider'::class );

    $this->container = Container::getInstance( $definitions, new Storage() );
  }

  /**
   * @test
   */
  public function containerHas (): void {

    $this->assertTrue( $this->container->has( 'HookLoader' ) );

    $this->assertTrue( $this->container->has( 'WpTheme\\Scaffold\\Framework\\Services\\HookLoader'::class ) );

    $this->assertFalse( $this->container->has( 'NotRegistered' ) );
  }

  /**
   * @test
   */
  public function containerGet (): void {

    $loader = $this->container->get( 'HookLoader' );

    $this->assertInstanceOf( 'WpTheme\\Scaffold\\Framework\\Interfaces\\LoaderInterface'::class, $loader );
  }
}