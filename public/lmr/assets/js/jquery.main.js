$('.diagramCircle').each(function(){
	$('#'+$(this).attr('id')).circleDiagram();
});

// page init
jQuery(function(){
  // initAccordion();
  //  initSameHeight();
  // jQuery('.tabset').tabset();
  //  initBackgroundResize();
});


// stretch background to fill blocks
function initBackgroundResize() {
 jQuery('.bg-stretch').each(function() {
  ImageStretcher.add({
   container: this,
   image: 'img'
  });
 });
}

// align blocks height
function initSameHeight() {
  jQuery('.column-holder').sameHeight({
    elements: '.title',
    flexible: true,
    multiLine: true
  });
  jQuery('.column-holder').sameHeight({
    elements: '.heading',
    flexible: true,
    multiLine: true
  });
   jQuery('.content').sameHeight({
    elements: 'p',
    flexible: true,
    multiLine: true
  });
}


// accordion init
// function initAccordion() {
//   jQuery('.nav-menu').slideAccordion({
//     opener:'>a.opener',
//     slider:'>.slide',
//     collapsible:true,
//     animSpeed: 300
//   });
// }

/*
 * jQuery SameHeight plugin
 */
;(function($){
  $.fn.sameHeight = function(opt) {
    var options = $.extend({
      skipClass: 'same-height-ignore',
      leftEdgeClass: 'same-height-left',
      rightEdgeClass: 'same-height-right',
      elements: '>*',
      flexible: false,
      multiLine: false,
      useMinHeight: false,
      biggestHeight: false
    },opt);
    return this.each(function(){
      var holder = $(this), postResizeTimer, ignoreResize;
      var elements = holder.find(options.elements).not('.' + options.skipClass);
      if(!elements.length) return;

      // resize handler
      function doResize() {
        elements.css(options.useMinHeight && supportMinHeight ? 'minHeight' : 'height', '');
        if(options.multiLine) {
          // resize elements row by row
          resizeElementsByRows(elements, options);
        } else {
          // resize elements by holder
          resizeElements(elements, holder, options);
        }
      }
      doResize();

      // handle flexible layout / font resize
      var delayedResizeHandler = function() {
        if(!ignoreResize) {
          ignoreResize = true;
          doResize();
          clearTimeout(postResizeTimer);
          postResizeTimer = setTimeout(function() {
            doResize();
            setTimeout(function(){
              ignoreResize = false;
            }, 10);
          }, 100);
        }
      };

      // handle flexible/responsive layout
      if(options.flexible) {
        $(window).bind('resize orientationchange fontresize', delayedResizeHandler);
      }

      // handle complete page load including images and fonts
      $(window).bind('load', delayedResizeHandler);
    });
  };

  // detect css min-height support
  var supportMinHeight = typeof document.documentElement.style.maxHeight !== 'undefined';

  // get elements by rows
  function resizeElementsByRows(boxes, options) {
    var currentRow = $(), maxHeight, maxCalcHeight = 0, firstOffset = boxes.eq(0).offset().top;
    boxes.each(function(ind){
      var curItem = $(this);
      if(curItem.offset().top === firstOffset) {
        currentRow = currentRow.add(this);
      } else {
        maxHeight = getMaxHeight(currentRow);
        maxCalcHeight = Math.max(maxCalcHeight, resizeElements(currentRow, maxHeight, options));
        currentRow = curItem;
        firstOffset = curItem.offset().top;
      }
    });
    if(currentRow.length) {
      maxHeight = getMaxHeight(currentRow);
      maxCalcHeight = Math.max(maxCalcHeight, resizeElements(currentRow, maxHeight, options));
    }
    if(options.biggestHeight) {
      boxes.css(options.useMinHeight && supportMinHeight ? 'minHeight' : 'height', maxCalcHeight);
    }
  }

  // calculate max element height
  function getMaxHeight(boxes) {
    var maxHeight = 0;
    boxes.each(function(){
      maxHeight = Math.max(maxHeight, $(this).outerHeight());
    });
    return maxHeight;
  }

  // resize helper function
  function resizeElements(boxes, parent, options) {
    var calcHeight;
    var parentHeight = typeof parent === 'number' ? parent : parent.height();
    boxes.removeClass(options.leftEdgeClass).removeClass(options.rightEdgeClass).each(function(i){
      var element = $(this);
      var depthDiffHeight = 0;
      var isBorderBox = element.css('boxSizing') === 'border-box' || element.css('-moz-box-sizing') === 'border-box' || '-webkit-box-sizing' === 'border-box';

      if(typeof parent !== 'number') {
        element.parents().each(function(){
          var tmpParent = $(this);
          if(parent.is(this)) {
            return false;
          } else {
            depthDiffHeight += tmpParent.outerHeight() - tmpParent.height();
          }
        });
      }
      calcHeight = parentHeight - depthDiffHeight;
      calcHeight -= isBorderBox ? 0 : element.outerHeight() - element.height();

      if(calcHeight > 0) {
        element.css(options.useMinHeight && supportMinHeight ? 'minHeight' : 'height', calcHeight);
      }
    });
    boxes.filter(':first').addClass(options.leftEdgeClass);
    boxes.filter(':last').addClass(options.rightEdgeClass);
    return calcHeight;
  }
}(jQuery));

/*
 * jQuery FontResize Event
 */
jQuery.onFontResize = (function($) {
  $(function() {
    var randomID = 'font-resize-frame-' + Math.floor(Math.random() * 1000);
    var resizeFrame = $('<iframe>').attr('id', randomID).addClass('font-resize-helper');

    // required styles
    resizeFrame.css({
      width: '100em',
      height: '10px',
      position: 'absolute',
      borderWidth: 0,
      top: '-9999px',
      left: '-9999px'
    }).appendTo('body');

    // use native IE resize event if possible
    if (window.attachEvent && !window.addEventListener) {
      resizeFrame.bind('resize', function () {
        $.onFontResize.trigger(resizeFrame[0].offsetWidth / 100);
      });
    }
    // use script inside the iframe to detect resize for other browsers
    else {
      var doc = resizeFrame[0].contentWindow.document;
      doc.open();
      doc.write('<scri' + 'pt>window.onload = function(){var em = parent.jQuery("#' + randomID + '")[0];window.onresize = function(){if(parent.jQuery.onFontResize){parent.jQuery.onFontResize.trigger(em.offsetWidth / 100);}}};</scri' + 'pt>');
      doc.close();
    }
    jQuery.onFontResize.initialSize = resizeFrame[0].offsetWidth / 100;
  });
  return {
    // public method, so it can be called from within the iframe
    trigger: function (em) {
      $(window).trigger("fontresize", [em]);
    }
  };
}(jQuery));


/*
 * jQuery Accordion plugin
 */
;(function($){
  $.fn.slideAccordion = function(opt){
    // default options
    var options = $.extend({
      addClassBeforeAnimation: false,
      allowClickWhenExpanded: false,
      activeClass:'active',
      opener:'.opener',
      slider:'.slide',
      animSpeed: 300,
      collapsible:true,
      event:'click'
    },opt);

    return this.each(function(){
      // options
      var accordion = $(this);
      var items = accordion.find(':has('+options.slider+')');

      items.each(function(){
        var item = $(this);
        var opener = item.find(options.opener);
        var slider = item.find(options.slider);
        opener.bind(options.event, function(e){
          if(!slider.is(':animated')) {
            if(item.hasClass(options.activeClass)) {
              if(options.allowClickWhenExpanded) {
                return;
              } else if(options.collapsible) {
                slider.slideUp(options.animSpeed, function(){
                  hideSlide(slider);
                  item.removeClass(options.activeClass);
                });
              }
            } else {
              // show active
              var levelItems = item.siblings('.'+options.activeClass);
              var sliderElements = levelItems.find(options.slider);
              item.addClass(options.activeClass);
              showSlide(slider).hide().slideDown(options.animSpeed);
            
              // collapse others
              sliderElements.slideUp(options.animSpeed, function(){
                levelItems.removeClass(options.activeClass);
                hideSlide(sliderElements);
              });
            }
          }
          e.preventDefault();
        });
        if(item.hasClass(options.activeClass)) showSlide(slider); else hideSlide(slider);
      });
    });
  };


;(function($, $win) {
  'use strict';

  function Tabset($holder, options) {
    this.$holder = $holder;
    this.options = options;

    this.init();
  }

  Tabset.prototype = {
    init: function() {
      this.$tabLinks = this.$holder.find(this.options.tabLinks);

      this.setStartActiveIndex();
      this.setActiveTab();

      if (this.options.autoHeight) {
        this.$tabHolder = $(this.$tabLinks.eq(0).attr(this.options.attrib)).parent();
      }
    },

    setStartActiveIndex: function() {
      var $activeLink = this.$tabLinks.filter('.' + this.options.activeClass);
      var $hashLink = this.$tabLinks.filter('[' + this.options.attrib + '="' + location.hash + '"]');
      var activeIndex;

      if (this.options.checkHash && $hashLink.length) {
        $activeLink = $hashLink;
      }

      activeIndex = this.$tabLinks.index($activeLink);

      this.activeTabIndex = this.prevTabIndex = (activeIndex === -1 ? 0 : activeIndex);
    },

    setActiveTab: function() {
      var self = this;

      this.$tabLinks.each(function(i, link) {
        var $link = $(link);
        var $classTarget = self.getClassTarget($link);
        var $tab = $($link.attr(self.options.attrib));

        if (i !== self.activeTabIndex) {
          $classTarget.removeClass(self.options.activeClass);
          $tab.addClass(self.options.tabHiddenClass).removeClass(self.options.activeClass);
        } else {
          $classTarget.addClass(self.options.activeClass);
          $tab.removeClass(self.options.tabHiddenClass).addClass(self.options.activeClass);
        }

        self.attachTabLink($link, i);
      });
    },

    attachTabLink: function($link, i) {
      var self = this;

      $link.on(this.options.event + '.tabset', function(e) {
        e.preventDefault();

        if (self.activeTabIndex === self.prevTabIndex && self.activeTabIndex !== i) {
          self.activeTabIndex = i;
          self.switchTabs();
        }
      });
    },
    
    resizeHolder: function(height) {
      var self = this;

      if (height) {
        this.$tabHolder.height(height);
        setTimeout(function() {
          self.$tabHolder.addClass('transition');
        }, 10);
      } else {
        self.$tabHolder.removeClass('transition').height('');
      }
    },

    switchTabs: function() {
      var self = this;

      var $prevLink = this.$tabLinks.eq(this.prevTabIndex);
      var $nextLink = this.$tabLinks.eq(this.activeTabIndex);

      var $prevTab = this.getTab($prevLink);
      var $nextTab = this.getTab($nextLink);

      $prevTab.removeClass(this.options.activeClass);

      if (self.haveTabHolder()) {
        this.resizeHolder($prevTab.outerHeight());
      }

      setTimeout(function() {
        self.getClassTarget($prevLink).removeClass(self.options.activeClass);

        $prevTab.addClass(self.options.tabHiddenClass);
        $nextTab.removeClass(self.options.tabHiddenClass).addClass(self.options.activeClass);

        self.getClassTarget($nextLink).addClass(self.options.activeClass);

        if (self.haveTabHolder()) {
          self.resizeHolder($nextTab.outerHeight());

          setTimeout(function() {
            self.resizeHolder();
            self.prevTabIndex = self.activeTabIndex;
          }, self.options.animSpeed);
        } else {
          self.prevTabIndex = self.activeTabIndex;
        }
      }, this.options.autoHeight ? this.options.animSpeed : 1);
    },

    getClassTarget: function($link) {
      return this.options.addToParent ? $link.parent() : $link;
    },

    getActiveTab: function() {
      return this.getTab(this.$tabLinks.eq(this.activeTabIndex));
    },

    getTab: function($link) {
      return $($link.attr(this.options.attrib));
    },

    haveTabHolder: function() {
      return this.$tabHolder && this.$tabHolder.length;
    },

    destroy: function() {
      var self = this;

      this.$tabLinks.off('.tabset').each(function() {
        var $link = $(this);

        self.getClassTarget($link).removeClass(self.options.activeClass);
        $($link.attr(self.options.attrib)).removeClass(self.options.activeClass + ' ' + self.options.tabHiddenClass);
      });

      this.$holder.removeData('Tabset');
    }
  };

  $.fn.tabset = function(options) {
    options = $.extend({
      activeClass: 'active',
      addToParent: false,
      autoHeight: false,
      checkHash: false,
      animSpeed: 500,
      tabLinks: 'a',
      attrib: 'href',
      event: 'click',
      tabHiddenClass: 'js-tab-hidden'
    }, options);
    options.autoHeight = options.autoHeight && $.support.opacity;

    return this.each(function() {
      var $holder = $(this);

      if (!$holder.data('Tabset')) {
        $holder.data('Tabset', new Tabset($holder, options));
      }
    });
  };
}(jQuery, jQuery(window)));


  // accordion slide visibility
  var showSlide = function(slide) {
    return slide.css({position:'', top: '', left: '', width: '' });
  };
  var hideSlide = function(slide) {
    return slide.show().css({position:'absolute', top: -9999, left: -9999, width: slide.width() });
  };
}(jQuery));


/*
 * Image Stretch module
 */
var ImageStretcher = {
 getDimensions: function(data) {
  // calculate element coords to fit in mask
  var ratio = data.imageRatio || (data.imageWidth / data.imageHeight),
   slideWidth = data.maskWidth,
   slideHeight = slideWidth / ratio;

  if(slideHeight < data.maskHeight) {
   slideHeight = data.maskHeight;
   slideWidth = slideHeight * ratio;
  }
  return {
   width: slideWidth,
   height: slideHeight,
   top: (data.maskHeight - slideHeight) / 2,
   left: (data.maskWidth - slideWidth) / 2
  };
 },
 getRatio: function(image) {
  if(image.prop('naturalWidth')) {
   return image.prop('naturalWidth') / image.prop('naturalHeight');
  } else {
   var img = new Image();
   img.src = image.prop('src');
   return img.width / img.height;
  }
 },
 imageLoaded: function(image, callback) {
  var self = this;
  var loadHandler = function() {
   callback.call(self);
  };
  if(image.prop('complete')) {
   loadHandler();
  } else {
   image.one('load', loadHandler);
  }
 },
 resizeHandler: function() {
  var self = this;
  jQuery.each(this.imgList, function(index, item) {
   if(item.image.prop('complete')) {
    self.resizeImage(item.image, item.container);
   }
  });
 },
 resizeImage: function(image, container) {
  this.imageLoaded(image, function() {
   var styles = this.getDimensions({
    imageRatio: this.getRatio(image),
    maskWidth: container.width(),
    maskHeight: container.height()
   });
   image.css({
    width: styles.width,
    height: styles.height,
    marginTop: styles.top,
    marginLeft: styles.left
   });
  });
 },
 add: function(options) {
  var container = jQuery(options.container ? options.container : window),
   image = typeof options.image === 'string' ? container.find(options.image) : jQuery(options.image);

  // resize image
  this.resizeImage(image, container);

  // add resize handler once if needed
  if(!this.win) {
   this.resizeHandler = jQuery.proxy(this.resizeHandler, this);
   this.imgList = [];
   this.win = jQuery(window);
   this.win.on('resize orientationchange', this.resizeHandler);
  }

  // store item in collection
  this.imgList.push({
   container: container,
   image: image
  });
 }
};