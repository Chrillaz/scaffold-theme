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

<<<<<<< HEAD
<<<<<<< HEAD
  const bar = document.querySelector('.cookie') as HTMLElement,
<<<<<<< HEAD
=======
  const bar = document.querySelector('.cookie-notice') as HTMLElement,
>>>>>>> cookies
        button = document.querySelector( '.cookie-accept' ) as HTMLAnchorElement,
        timeout = bar.getAttribute( 'data-delay' );
=======
        button = document.querySelector( '.cookie-accept' ) as HTMLAnchorElement;
>>>>>>> script fix
=======
  const bar = document.querySelector('.cookie') as HTMLElement,
        button = document.querySelector( '.cookie-accept' ) as HTMLAnchorElement;
>>>>>>> 02df48760ec49b9172c1a2906f090008f686dba4

  if ( bar && bar.dataset.visible === 'false' ) {
    
    setTimeout(() => bar.setAttribute( 'data-visible', 'true'), parseInt( bar.getAttribute( 'data-delay' ) as string ) );
  }

  if ( button ) {

    button.addEventListener( 'click', event => dismiss( event ).then( accepted => {

      accepted ? bar.setAttribute( 'data-visible', 'false' ) : false;
    }));
  }
}