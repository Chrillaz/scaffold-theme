import Wp from './contracts/wp'
import React from './contracts/react'

declare global {
  interface Window {
    wp: Wp;
    React: React;
  }
}

export {}