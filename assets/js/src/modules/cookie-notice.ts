function dismiss ( event: Event ) {

  event.preventDefault();
  
  return new Promise(( resolve ) => {

    if ( window.localStorage ) {
  
      localStorage.setItem( 'cookieAccepted', 'true' );
    }

    resolve( localStorage.getItem( 'cookieAccepted' ) != null ? true : false );
  })
}

export const runCookieNotice = () => {

  if ( window.localStorage && localStorage.getItem( 'cookieAccepted' ) != null ) {

    return;
  }

  const bar = document.querySelector('.cookie') as HTMLElement,
        button = document.querySelector( '.cookie-accept' ) as HTMLAnchorElement;

  if ( bar && bar.dataset.visible === 'false' ) {
    
    setTimeout(() => bar.setAttribute( 'data-visible', 'true'), parseInt( bar.getAttribute( 'data-delay' ) as string ) );
  }

  if ( button ) {

    button.addEventListener( 'click', event => dismiss( event ).then( accepted => {

      accepted ? bar.setAttribute( 'data-visible', 'false' ) : false;
    }));
  }
}