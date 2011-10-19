/**
 *	UI Layout Callback: resizePaneAccordions
 *
 *	Version:	1.0 - 2011-07-10
 *	Author:		Kevin Dalman (kevin.dalman@gmail.com)
 */
;(function(b){var a=b.layout;if(!a.callbacks)a.callbacks={};a.callbacks.resizePaneAccordions=function(a,c){(c.jquery?c:b(c.panel)).find(".ui-accordion:visible").each(function(){var a=b(this);a.data("accordion")&&a.accordion("resize")})}})(jQuery);