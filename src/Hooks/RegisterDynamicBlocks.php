<?php

namespace Scaffold\Theme\Hooks;

use \Scaffold\Essentials\Abstracts\Hooks;

use \Scaffold\Essentials\Services\HookLoader;

final class RegisterDynamicBlocks extends Hooks 
{

  public function registerBlocks() 
  {
    // Example...
    // \register_block_type( 'scaffold/block-name', [
    //   'render_callback' => [ 
    //     $this->container->make( \Scaffold\Theme\DynamicBlocks\ExampleDynamicBlock::class ), 
    //     'render' 
    //   ]
    // ]);
  }

  public function register( HookLoader $hooks ): void 
  {

    // $hooks->addAction( 'init', 'registerBlocks', $this );

    // $hooks->load();
  }
}