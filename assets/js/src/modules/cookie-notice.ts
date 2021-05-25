function dismiss ( event: Event ) {

  event.preventDefault();

    if ( window.localStorage ) {

      localStorage.setItem( 'cookieAccepted', 'true' );
    }

    const bar = document.querySelector( '.cookie-notice' ) as HTMLElement;

    bar.setAttribute( 'data-visible', 'false' );
}

export const runCookieNotice = () => {

  if ( window.localStorage ) {

    const hasAccepted = localStorage.getItem( 'cookieAccepted' );

    if ( hasAccepted ) {

      return;
    }
  }

  const bar = document.querySelector('.cookie-notice') as HTMLElement,
        button = document.querySelector( '.cookie-accept' ) as HTMLAnchorElement;

  if ( bar.dataset.visible === 'false' ) {
    
    setTimeout(() => bar.setAttribute( 'data-visible', 'true'), 4000);
  }

  if ( button ) {

    button.addEventListener( 'click', dismiss );
  }
}