// import external dependencies
import 'jquery';

// Import everything from autoload
import 'bootstrap'

import '../styles/main.scss'

// import local dependencies
import Router from './util/Router';
import common from './routes/common';
import home from './routes/home';
import aboutUs from './routes/about';

/** Populate Router instance with DOM routes */
const routes = new Router({
  // All pages
  common,
  // Home page
  home,
  // About Us page, note the change from about-us to aboutUs.
  aboutUs,
});

const SlideDuration = 250;

// Load Events
jQuery(document).ready(() => {
  routes.loadEvents();
  console.log('sanity check');

  let isMobile = window.matchMedia("only screen and (max-width: 992px)").matches;


  if(!isMobile) {

    // Return focus back to the main menu when exiting a menu panel
    jQuery('.menu-panel').each( (i, p) => {
      jQuery(p).find('a[href], button, input, [tabindex]:not([tabindex="-1"])').last().on('blur', (e) => {
        // debugger;
        jQuery( `a[aria-controls=${jQuery(p).attr('id')}]`).first().focus()
      })
    })
  }

  // jQuery('.menu-item-title').on('focus', (e) => {
  //   jQuery('li.has-megamenu').removeClass('active');
  //   jQuery('a.menu-item-title').attr({'aria-expanded': false, 'aria-pressed': false});
  //   jQuery( '.menu-panel:visible' ).slideUp(SlideDuration);
  // })

  jQuery( '.toggle-button' ).on('click', (e) => {
    e.preventDefault();
    e.stopPropagation();
    let us = jQuery( e.currentTarget );
    let controls = jQuery( us.attr('aria-controls') ).first();
    // debugger;
    switch( us.attr('aria-expanded' ) ) {
      case "false":
        controls.slideDown( SlideDuration, (e) => {
          // debugger;
          us.attr({'aria-expanded': true, 'aria-pressed': true}).addClass('active');
          // Pre-focus the first element of the thing we just expanded
          controls.find('a[href], button, input, [tabindex]:not([tabindex="-1"])').first().focus()
        })
        break;
      case "true":
        controls.slideUp( SlideDuration, (e) => {
          us.attr({'aria-expanded': false, 'aria-pressed': false}).removeClass('active').blur();
        })
        break;
    }
  })

  jQuery('li.has-megamenu').on('click', (e) => {
    e.preventDefault();
    e.stopPropagation();
    let us = jQuery( e.currentTarget )
    let a = us.find('a.menu-item-title').first()
    let panel_id = a.attr('aria-controls');
    let panel = jQuery('#'+panel_id).first();
    let menu_group = a.data('menu-group');
    // debugger;
    // Default state: go ahead and slide up any other menus
   
    let openMenuPanels = jQuery( '.menu-panel:visible' );
    switch( a.attr('aria-expanded') ) {
      case "true":
        // debugger;
        jQuery('.menu-panel').slideUp(SlideDuration);
        
        // Delete menu copy present on desktop
        jQuery( '#main-menu > .menu-panel').slideUp(SlideDuration, () => {
          $(this).detach();
        });
        us.removeClass('active');
        a.attr('aria-expanded', false);
        break;
      case "false":
        // debugger;
        jQuery('.has-megamenu').removeClass('active');
        jQuery('.menu-item-title').attr({'aria-expanded': false, 'aria-pressed': false});

        a.attr('aria-expanded', false).attr({'aria-expanded': true, 'aria-pressed': true});
        us.addClass('active');

        if(openMenuPanels.length > 0) {
          openMenuPanels.slideUp(SlideDuration, () => {
            if(isMobile) {
              jQuery( `#${menu_group}` ).detach().appendTo( us );
            }
            slideDown(panel);
          })
        } else {
          if(isMobile) {
            jQuery( `#${menu_group}` ).detach().appendTo( us );
          }
          slideDown(panel);
        }

        a.on('blur', (e) => {
          panel.find('a[href], button, input, [tabindex]:not([tabindex="-1"])').first().focus()
        })
        
    }
    
  });

  let slideDown = function(panel) {
    panel.slideDown(SlideDuration)
  }

  // Simulate click when keyboard navigating
  jQuery('[role=button]').on('keyup', (e) => {
    if(e.keyCode == 13) {
      jQuery(e.currentTarget).click();
    }
  })  

  jQuery('#main-menu-toggle').on('click', (e) => {
    jQuery('#main-menu > ul').slideToggle(100);
  });
});


