<?php

class EnqueueScriptsTest extends WP_UnitTestCase {

  public function testInstance () {
    $storage = new \WpTheme\Scaffold\Framework\Resources\Storage();

    $this->assertInstanceOf( \WpTheme\Scaffold\Framework\Interfaces\StorageInterface::class, $storage );
    $this->assertTrue(
      method_exists($storage, 'get'), 
      'Class does not have method myFunction'
    );
  }
}