<?php

namespace WPTheme\Scaffold\Contracts;

interface Storage {

  /**
   * Checks wether storage contains given value, could be either key or value
   * 
   * @param mixed $value
   * 
   * @return bool
   */
  public function contains ( $value ): bool;

  /**
   * Retrieve value by given key, returns false if value doesn't exist
   * 
   * @param string $key
   * 
   * @return mixed|false
   */
  public function get ( string $key );

  /**
   * Returns the entire storage array
   * 
   * @return array
   */
  public function all (): array;

  /**
   * Collect values by key from storage
   * 
   * @param array $keys
   * 
   * @return array
   */
  public function collect ( ...$keys ): array;

  /**
   * Updates value by given key, returns false if value can't be updated
   * 
   * @param string $key
   * 
   * @param mixed $value
   * 
   * @return mixed|false
   */
  public function update ( string $key, $value );

  /**
   * Unsets value by given key from storage
   * 
   * @param string $key
   * 
   * @return bool
   */
  public function delete ( string $key ): bool;

  /**
   * Overrides the default empty storage with given list
   * Multidimentional lists gets flattended before assigned as storage
   * 
   * @param array $list
   * 
   * @return void
   */
  public function create ( $list ): void;
}