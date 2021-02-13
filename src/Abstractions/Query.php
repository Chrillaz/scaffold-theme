<?php

namespace WPTheme\Scaffold\Abstractions;

class Query {

  private $query = [];

  public function where ( $posttype, string $orderby ) {

    $this->query['post_type']   = $posttype;
    $this->query['orderby']     = $orderby;
    $this->query['post_status'] = 'publish';
    
    return $this;
  }

  public function in ( $taxonomy, ...$terms ) {

    $this->query['tax_query'] = [
      [
        'taxonomy' => $taxonomy,
        'field'    => 'slug',
        'terms'    => $terms
      ]
    ];

    return $this;
  }

  public function limit ( int $limit ) {

    $this->query['posts_per_page'] = $limit;

    return $this;
  }

  public function sort ( string $order ) {

    $this->query['order'] = $order;

    return $this;
  }

  public function get () {

    return new \WP_Query( $this->query );
  }

  public function all () {

  }
}