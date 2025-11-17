
//  Link media
require.context('../media/', true, /^\.\/.*\.*/);
require.context('../fonts/', true, /^\.\/.*\.*/);

// Global styles
// import '@wrap.ngo/evergreen/styles';
// // Optional font import
// import '@wrap.ngo/evergreen/fonts';
// // Component registration
import '@wrap.ngo/evergreen/components'

// import "https://esm.sh/@wrap.ngo/evergreen/components";


//  Styles
import '../styles/styles.scss';


// JS
import $ from 'jquery';

// import utils from './proj/utils';
// import handleLazySizes from './proj/handleLazySizes';
// import handleContainSizing from './proj/handleContainSizing';
// import barba from '@barba/core';
// import Vivus from 'vivus';
// import shave from 'shave';

// import Lenis from '@studio-freight/lenis';
import { gsap } from "gsap";


let Site;
// const isMobileDevice = utils.mobileAndTabletCheck();
// const isMobile = window.innerWidth < 800 || isMobileDevice;

(function ($) {
	'use strict';

	Site = {
		/**
		 * initialize prototype
		 *
		 */
		init: function (elt) {
			var self = this;

			
			self.megamenu();
			self.accordions();

			
		},
		megamenu: function (elt) {
			$('.js-megamenu').on('click', function(){
				const toshow  = $(this).find('button').attr('aria-controls');

				if($(this).attr('active') != 'true') {
					$(this).attr('active', 'true');
					$(this).find('button').attr('aria-expanded', 'true');
					$(this).find('evg-icon').attr('icon', 'chevron-up');
					$('#'+toshow).attr('open', 'open');
				}
				else {
					$(this).attr('active', 'false');
					$(this).find('evg-icon').attr('icon', 'chevron-down');
					$(this).find('button').attr('aria-expanded', 'false');
					$('#'+toshow).removeAttr('open');
				}
			})
		},
		accordions: function (elt) {

			if($('.ae-accordion').length > 0){
				$('.ae-accordion__toggle').on('click', function(e){
					e.stopPropagation();
					if($(this).parent().hasClass('ae-accordion--closeothers')){
					   $(this).parent().parent().find('.ae-accordion').removeClass('is-open');
					   $(this).parent().parent().find('.ae-accordion__content').css('max-height', 0);
					}
					// open / toggle current 
					$(this).parent().toggleClass('is-open');

					const maxH = $(this).parent().find('.ae-accordion__content >div').height();
					if($(this).parent().hasClass('is-open')){
						$(this).parent().find('.ae-accordion__content').css('max-height', maxH);
					}
					else {
						$(this).parent().find('.ae-accordion__content').css('max-height', 0);
					}

				});

				$('.ae-accordion.is-open').each(function(){
					const maxH = $(this).find('.ae-accordion__content >div').height();
					$(this).find('.ae-accordion__content').css('max-height', maxH);
				});
			}

			if($('.mod-popup-accordion').length > 0) {
				if($(window).width() > 768) {
					$('.ae-accordion').find('.ae-accordion__toggle').eq(0).trigger('click');
				}

			}
		},

		removeOrphans: function(){
			// remove orphans / widows 
			$('.mod-copy p').each(function() {
				const text = $(this).html();
				const words = text.split(' ');
				const totalWords = words.length;

				if(!$(this).parents().hasClass('dont-apply-words-nowrap')) {

					// Ensure there are at least 2 words
					if (totalWords >= 2) {
						const formattedLastWords = `<span class="words-nowrap">${words[totalWords - 2]} ${words[totalWords - 1]}</span>`;
						const newText = text.substring(0, text.length - (words[totalWords - 2].length + words[totalWords - 1].length + 1)) + formattedLastWords;
						$(this).html(newText);
					}
				}
			});
		},

		/**
		 * Sticky Section GENERIC
		 *
		 */
		scrolltriggerAnimations: function(){
			const self = this;

			// each paragraph of trigger
			// $('.js-wp-trigger').each(function(){

			// 	const target = '.'+$(this).attr('data-target');
			// 	const addClass = $(this).attr('data-class');
			// 	const offset = $(this).attr('data-offset');
			
			// 	const $trigger = $(this);

			// 	ScrollTrigger.create({
			// 		trigger: $trigger,
			// 		// markers: true,
			// 		start: "top "+offset,
			// 		onEnter: function($quote){
			// 			$(target).addClass( addClass );
			// 		},

			// 		onEnterBack: function($quote){ 

			// 		},

			// 		onLeave: function($quote){ 
		
			// 		},
			// 		onLeaveBack: function($quote){ 
			// 			$(target).removeClass( addClass );
			// 		},
			// 	});
			// });


			// 	ScrollTrigger matchMedia
			ScrollTrigger.saveStyles("");


			ScrollTrigger.matchMedia({
				'(min-width:768px)':function(){

				},
				'(max-width:767px)':function(){
							
				},
				// persistent for all breakpoints
				'all': function() {  

					$('.js-anim-children--fade').each(function(){
						var elts = $(this).children();

						gsap.set(elts, {y: 0, opacity: 0});

						ScrollTrigger.batch(elts, {
							// markers: true,
							start: "top 90%",
							onEnter: function(batch){  gsap.to(batch, {opacity: 1, y: 0, stagger: 0.45, duration: 0.6, overwrite: true})},
						});
					})


					$("[class*='ivanim-']").each(function(){
						const $el = $(this);

						ScrollTrigger.create({
							trigger: $el, 
							// markers: true,
							id: "inview",
							start: "top bottom",
							onEnter: function(){
								if (!$el.hasClass('is-inview')) {
									$el.addClass('is-inview');
								}
							}
						});
					});
					// inview repeat
					$("[class*='ivanimr-']").each(function(){
						const $el = $(this);

						ScrollTrigger.create({
							trigger: $el, 
							// markers: true,
							start: "top bottom",
							onEnter: function(){
								if (!$el.hasClass('is-inview')) {
									$el.addClass('is-inview');
								}
							},
							onLeave: function(){ 
								// if ($el.hasClass('is-inview')) {
								// 	$el.removeClass('is-inview');
								// }
							},
							onEnterBack: function(){ 
								// if (!$el.hasClass('is-inview')) {
								// 	$el.addClass('is-inview');
								// }
							},
							onLeaveBack: function(){ 
								if ($el.hasClass('is-inview')) {
									$el.removeClass('is-inview');
								}
							},
						});
					});
				}
			})

		},






		countUpNumbers: function (section) {
			function numberWithCommas(x) {
				return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
			}
		
			function animateState(el){
				const count = $(el);
				const comma = $(el).data('comma') || true;
				const countUpDuration = $(el).attr('data-duration') || 1;
		
				gsap.to(count, {
					innerText: count.attr("data-number"),
					snap: {innerText: 1},
					stagger: {
						each: 1.0,
						onUpdate: function() {
							if(comma) {
								this.targets()[0].innerHTML = numberWithCommas(Math.ceil(this.targets()[0].innerText));
							}
						},
					},
					duration: countUpDuration
				});
		
			}
	
			$('.js-stat-number').each(function(el){

				const $el = $(this);

				ScrollTrigger.create({
					trigger: $el, 
					// markers: true,
					id: "inview",
					start: "top 95%",
					once: true,
					onEnter: function(){
						$('.js-stat-number').html(0);
						animateState($el);
						// if (!$el.hasClass('is-inview')) {
							// $el.addClass('is-inview');
						// }
					},
					// onEnterBack: function(){
					// 	$('.js-stat-number').html(0);
					// 	animateState($el);
					// }
				});
				
			});
		
		},


	};


	$(document).ready( function(){
		Site.init();
	})

})(jQuery);
