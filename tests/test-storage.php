<?php

use PHPUnit\Framework\TestCase;

use WpTheme\Scaffold\Framework\Resources\Storage;

class StorageTest extends TestCase {
  
  private $values;

  private $storage;

  protected function setUp (): void {

    $this->values = [
      'key1' => 'value 1',
      'key2' => 'value 2',
      'key3' => 'value 3'
    ];

    $this->storage = new Storage( $this->values );
  }

  /**
   * @test
   */
  public function storageContains (): void {
    
    $this->assertTrue( $this->storage->contains( 'key2' ) );

    $this->assertTrue( $this->storage->contains( 'value 1' ) );

    $this->assertFalse( $this->storage->contains( 'key5' ) );

    $this->assertFalse( $this->storage->contains( 'Not in storage value' ) );
  }

  /**
   * @test
   */
  public function storageGet (): void {

    $this->assertEquals( 'value 3', $this->storage->get( 'key3' ) );

    $this->assertFalse( $this->storage->get( 'key4' ) );
  }

  /**
   * @test
   */
  public function storageAll (): void {

    $this->assertIsArray( $this->storage->all() );

    $this->assertEquals( $this->values, $this->storage->all() );
  }

  /**
   * @test
   */
  public function storageCollect (): void {

    $collected = $this->storage->collect( 'key1', 'key3' );

    $this->assertIsArray( $collected );

    $this->assertCount( 2, $collected );
  }

  /**
   * @test
   */
  public function storageSet (): void {

    $this->storage->set( 'key4', 'value 4' );

    $this->assertTrue( $this->storage->contains( 'value 4' ) );

    $this->assertEquals( 'value 4', $this->storage->get( 'key4' ) );
    
    $this->assertCount( 4, $this->storage->all() );
  }

  /**
   * @test
   */
  public function storageDelete (): void {
    
    $this->assertFalse( $this->storage->delete( 'key5' ) );

    $this->assertTrue( $this->storage->delete( 'key3' ) );

    $this->assertFalse( $this->storage->get( 'key3' ) );

    $this->assertCount( 2, $this->storage->all() );
  }
}