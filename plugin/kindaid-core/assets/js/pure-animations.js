(function ($) {
    'use strict';

    /**
     * PureAnimations Library
     * Extendable via window.PureAnimations prototype
     */
    var PureAnimations = function() {
        this.selector = '[data-pure-anim]'; 
    };

    PureAnimations.prototype.isEditMode = function () {
        return typeof elementorFrontend !== 'undefined' && elementorFrontend.isEditMode();
    };

    PureAnimations.prototype.init = function($scope) {
        var self = this;
        var isEditMode = this.isEditMode();
        var action = isEditMode ? 'animate' : 'observe';

        // Check if scope is target
        if (self.isTarget($scope)) {
            self[action]($scope[0]);
        }

        // Find children
        $scope.find(self.selector).each(function() {
            self[action](this);
        });

        // Live Preview in Editor
        if (isEditMode) {
            self.editorObserver($scope);
        }
    };

    PureAnimations.prototype.isTarget = function($element) {
        // Primary check: data attribute (server-rendered)
        if ($element.is('[data-pure-anim]')) {
            return true;
        }
        
        // Editor fallback: Check for classes if data attribute is missing (live preview)
        // Matches 'tp-' prefix but excludes 'tp-animated'
        if (this.isEditMode()) {
            var className = $element.attr('class') || '';
            // Check for known animation class patterns or generic tp- prefix excluding 'tp-animated'
            // This allows extensibility: any class starting with 'tp-' will trigger animation logic in editor
            return /\btp-(?!animated\b)[a-z0-9-]+\b/.test(className);
        }
        
        return false;
    };

    PureAnimations.prototype.animate = function(element) {
        var $element = $(element);
        var delay = $element.attr('data-tp-delay');
        var duration = $element.attr('data-tp-duration');

        // Reset
        element.style.animationDelay = '';
        element.style.webkitAnimationDelay = '';
        element.style.animationDuration = '';
        element.style.webkitAnimationDuration = '';

        if (delay) {
            element.style.animationDelay = delay;
            element.style.webkitAnimationDelay = delay;
        }
        if (duration) {
            element.style.animationDuration = duration;
            element.style.webkitAnimationDuration = duration;
        }

        $element.removeClass('tp-animated');
        void element.offsetWidth; // Trigger reflow
        $element.addClass('tp-animated');
    };

    PureAnimations.prototype.observe = function(element) {
        var self = this;
        var observer = new IntersectionObserver(function(entries, obs) {
            entries.forEach(function(entry) {
                if (entry.isIntersecting) {
                    self.animate(entry.target);
                    obs.unobserve(entry.target);
                }
            });
        }, { threshold: 0.1 });
        
        $(element).removeClass('tp-animated');
        observer.observe(element);
    };

    PureAnimations.prototype.editorObserver = function($scope) {
        var self = this;
        var timer;
        var observer = new MutationObserver(function(mutations) {
            var shouldAnimate = false;
            mutations.forEach(function(mutation) {
                if (mutation.attributeName === "class") {
                    var oldClass = (mutation.oldValue || '').replace(/tp-animated/g, '').trim();
                    var newClass = (mutation.target.className || '').replace(/tp-animated/g, '').trim();
                    if (oldClass !== newClass) shouldAnimate = true;
                } else if (['data-tp-delay', 'data-tp-duration', 'data-pure-anim'].indexOf(mutation.attributeName) !== -1) {
                    shouldAnimate = true;
                }
            });
            
            if (shouldAnimate) {
                if (timer) clearTimeout(timer);
                timer = setTimeout(function() {
                    if (self.isTarget($scope)) self.animate($scope[0]);
                }, 200);
            }
        });

        observer.observe($scope[0], {
            attributes: true,
            attributeOldValue: true,
            attributeFilter: ['class', 'data-tp-delay', 'data-tp-duration', 'data-pure-anim']
        });
    };

    // Expose to window for extension
    window.PureAnimations = PureAnimations;

    $(window).on('elementor/frontend/init', function() {
        var pureAnim = new PureAnimations();
        elementorFrontend.hooks.addAction('frontend/element_ready/global', function($scope) {
            pureAnim.init($scope);
        });
    });

})(jQuery);