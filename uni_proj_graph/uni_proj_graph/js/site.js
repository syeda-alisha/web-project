
/* enable CSS features that have JavaScript */
jQuery('html').removeClass('no-js');

/* determine if screen can handle touch events */
if (!(('ontouchstart' in window) || (navigator.maxTouchPoints > 0) || (navigator.msMaxTouchPoints > 0))) jQuery('html').addClass('no-touch');

/* simple way of determining if user is using a mouse */
var screenHasMouse = false;
function themeTouchStart() {
	jQuery(window).off("mousemove");
	screenHasMouse = false;
	setTimeout(function() {
		jQuery(window).on("mousemove", themeMouseMove);
	}, 250);
}
function themeMouseMove() {
	screenHasMouse = true;
}
jQuery(window).on("touchstart", themeTouchStart).on("mousemove", themeMouseMove);
if (window.navigator.msPointerEnabled) {
	document.addEventListener("MSPointerDown", themeTouchStart, false);
}

jQuery(document).ready(function () {

	jQuery('.tooltip').tip();
	jQuery('.tabs, .rotator').tabify();

	var s = document.createElement('p').style, supportForTransitions = 'transition' in s || 'WebkitTransition' in s || 'MozTransition' in s || 'msTransition' in s || 'OTransition' in s, transitionSpeed = 250, transitionProp = 'all ' + transitionSpeed + 'ms ease';
	jQuery(document).delegate('.thumb.directional', 'mouseenter mouseleave', function( event ) {
		var $el = $(this), $hoverElem = $el.find('.info'), w = $el.width(), h = $el.height(), x = ( event.pageX - $el.offset().left - ( w/2 )) * ( w > h ? ( h/w ) : 1 ), y = ( event.pageY - $el.offset().top  - ( h/2 )) * ( h > w ? ( w/h ) : 1 ), direction = Math.round( Math.atan2(y, x) / 1.57079633 + 5 ) % 4, fromStyle, toStyle, slideFromTop = { left : '0px', top : '-100%' }, slideFromBottom = { left : '0px', top : '100%' }, slideFromLeft = { left : '-100%', top : '0px' }, slideFromRight = { left : '100%', top : '0px' }, slideTop = { top : '0px' }, slideLeft = { left : '0px' };
		switch( direction ) {
			case 0: // from top
				fromStyle = slideFromTop;
				toStyle = slideTop;
				break;
			case 1: // from right
				fromStyle = slideFromRight;
				toStyle = slideLeft;
				break;
			case 2: // from bottom
				fromStyle = slideFromBottom;
				toStyle = slideTop;
				break;
			case 3: // from left
				fromStyle = slideFromLeft;
				toStyle = slideLeft;
				break;
		};
		if( event.type === 'mouseenter' ) {
			$hoverElem.hide().css(fromStyle).show(0, function() {
				var $elem = $( this );
				if( supportForTransitions ) {
					$elem.css( 'transition', transitionProp );
				}
				$.fn.applyStyle = supportForTransitions ? $.fn.css : $.fn.animate;
				$elem.stop().applyStyle( toStyle, $.extend( true, [], { duration : transitionSpeed + 'ms' } ) );
			});
		}
		else {
			if( supportForTransitions ) {
				$hoverElem.css( 'transition', transitionProp);
			}
			$.fn.applyStyle = supportForTransitions ? $.fn.css : $.fn.animate;
			$hoverElem.stop().applyStyle( fromStyle, $.extend( true, [], { duration : transitionSpeed + 'ms' } ) );
		}
	});

	jQuery('.collapse .collapse-title').click(function(e){
		$li = jQuery(this).parent('li');
		$ul = $li.parent('.collapse');
		// check if only one collapse can be opened at a time
		if ($ul.hasClass('only-one-visible')) {
			jQuery('li',$ul).not($li).removeClass('active');
		}
		$li.toggleClass('active');
		e.preventDefault();
	});

	jQuery('.lightbox').fancybox({
		padding : 5,
		margin : [50, 20, 20, 20],
		maxWidth : '90%',
		maxHeight : '90%',
		loop : true,
		fitToView : true,
		mouseWheel : false,
		closeClick : true,
		helpers : {
			media : { } ,
			title : { type : 'outside' },
			overlay : { showEarly  : true, locked : false }
		}
	});

	/* handle both mouse hover and touch events */
	jQuery('#menu li').hover(
		function () { if (screenHasMouse) jQuery(this).addClass("hover"); },
		function () { if (screenHasMouse) jQuery(this).removeClass("hover"); }
	);
	if (!jQuery('html').hasClass('no-touch')) {
		jQuery('#menu li.has-children > a').on('click',function (e) {
			if ( ! screenHasMouse && ! window.navigator.msPointerEnabled && ! jQuery('#menu').hasClass('mobile')) {
				$parent = jQuery(this).parent();
				if (!$parent.parents('.hover').length) {
					jQuery('#menu li.has-children').not($parent).removeClass('hover');
				}
				$parent.toggleClass("hover");
				e.preventDefault();
			}
		});

		/* toggle visibile dropdowns if touched outside the menu area */
		jQuery(document).click(function(e){
			if (jQuery(e.target).parents('#menu').length > 0) return;
			jQuery('#menu li.has-children').removeClass('hover');
		});
	}

	jQuery('#menu-switch').click(function(e) {
		jQuery(this).toggleClass('on');
		jQuery('#menu').toggleClass('mobile');
		return false;
	});

	var $top_link = jQuery('#top-link');
	$top_link.click(function(e) {
		jQuery('html, body').animate({scrollTop:0}, 750);
		e.preventDefault();
		return false;
	});

	jQuery(window).resize(function() {
		if (jQuery(window).width() >= 768) {
			jQuery('#menu-switch').removeClass('on');
			jQuery('#menu').removeClass('mobile');
			jQuery('#tooltip:visible').css("opacity", 0);
			jQuery('.filter-container').css("height", '');
		}
	});
});

/* A fix for the iOS orientationchange zoom bug */
!function(a){function m(){d.setAttribute("content",g),h=!0}function n(){d.setAttribute("content",f),h=!1}function o(b){return a.orientation,90==Math.abs(a.orientation)?(h&&m(),void 0):(l=b.accelerationIncludingGravity,i=Math.abs(l.x),j=Math.abs(l.y),0==j||i/j>1.2?h&&n():h||m(),void 0)}var b=navigator.userAgent;if (/iPhone|iPad|iPod/.test(navigator.platform)&&/OS [1-5]_[0-9_]* like Mac OS X/i.test(b)&&b.indexOf("AppleWebKit")>-1&&-1==b.indexOf("CriOS")){var c=a.document;if (c.querySelector){var d=c.querySelector("meta[name=viewport]");if (d){var i,j,l,e=d&&d.getAttribute("content"),f=e+",maximum-scale=1",g=e+",maximum-scale=10",h=!0;a.addEventListener("orientationchange",m,!1),a.addEventListener("devicemotion",o,!1)}}}}(this);
