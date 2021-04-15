<?php

use PHPUnit\Framework\TestCase;

use WpTheme\Scaffold\Framework\Resources\Storage;

class StorageTest extends TestCase {
  
  public function test_basic_test () {

    $storage = new Storage([
      'key1' => 'value',
      'key2' => 'value',
      'key3' => 'value'
    ]);
    
    $this->assertTrue( $storage->contains( 'key2' ) );

    $this->assertFalse( $storage->get( 'key4' ) );
    
    $this->assertEquals( 'value', $storage->get( 'key2' ) );
    
    $this->assertIsArray( $storage->collect( 'key1', 'key3' ) ); 

    $this->assertIsArray( $storage->all() );
  }
}