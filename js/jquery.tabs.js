/**
 *	UI Layout Callback: resizeTabLayout
 *
 *	Version:	1.1 - 2011-07-10
 *	Author:		Kevin Dalman (kevin.dalman@gmail.com)
 */
;(function(b){var a=b.layout;if(!a.callbacks)a.callbacks={};a.callbacks.resizeTabLayout=function(a,c){(c.jquery?c:b(c.panel)).filter(":visible").find(".ui-layout-container:visible").andSelf().each(function(){var a=b(this).data("layout");a&&a.resizeAll()})}})(jQuery);