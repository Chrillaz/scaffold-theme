import Wp from './wp'

declare global {
  interface Window {
    wp: Wp;
  }
}
