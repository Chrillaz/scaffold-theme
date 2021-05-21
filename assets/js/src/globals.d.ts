import Wp from './contracts/wp'
import React from './contracts/react'

export {}

declare global {
  interface Window {
    wp: Wp;
    React: React;
  }
}