document.addEventListener( 'DOMContentLoaded', () => {

  const colors = document.querySelectorAll( '#color-picker' ) as NodeListOf<HTMLInputElement>;

  Array.from( colors ).forEach( input => {

    // @ts-ignore
    jQuery(input).wpColorPicker();
  })
});