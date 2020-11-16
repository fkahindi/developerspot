<?php

/* define( 'INCLUDE_DIR', dirname( __FILE__ ) . '/templates/' );

	$rules = array( 
		'templates'   => "/picture/(?'text'[^/]+)/(?'id'\d+)",    // '/picture/some-text/51'
		'album'     => "/album/(?'album'[\w\-]+)",              // '/album/album-slug'
		'category'  => "/category/(?'category'[\w\-]+)",        // '/category/category-slug'
		'page'      => "/page/(?'page'about|contact)",          // '/page/about', '/page/contact'
		'post'      => "/(?'post'[\w\-]+)",                     // '/post-slug'
		'home'      => "/"                                      // '/'
	);

	$uri = rtrim( dirname($_SERVER["SCRIPT_NAME"]), '/' );
	$uri = '/' . trim( str_replace( $uri, '', $_SERVER['REQUEST_URI'] ), '/' );
	$uri = urldecode( $uri );

	foreach ( $rules as $action => $rule ) {
		if ( preg_match( '~^'.$rule.'$~i', $uri, $params ) ) {
			/* now you know the action and parameters so you can 
			* include appropriate template file ( or proceed in some other way )
            */
            /*
			include( INCLUDE_DIR . $action . '.php' );

			// exit to avoid the 404 message 
			exit();
		}
	}

	// nothing is found so handle the 404 error
    include( INCLUDE_DIR . '404.php' ); */
    
    $path = ltrim($_SERVER['REQUEST_URI'], '/');    // Trim leading slash(es)
    $elements = explode('/', $path);                // Split path on slashes
    if(empty($elements[0])) {                       // No path elements means home
        ShowHomepage();
    } else switch(array_shift($elements))             // Pop off first item and switch
    {
        case 'Some-text-goes-here':
            ShowPicture($elements); // passes rest of parameters to internal function
            break;
        case 'more':
            ...
        default:
            header('HTTP/1.1 404 Not Found');
            Show404Error();
    }