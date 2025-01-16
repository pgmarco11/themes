var ThemifyAjax = {};
(function ($) {
    /** create mod exec controller */
    $.readyFn = {
        list: [],
        hash: [],
        hashCode: function (s) {
            s = $.trim(s);
            var hash = 0, strlen = s.length, i, c;
            if (strlen === 0) {
                return hash;
            }
            for (i = 0; i < strlen; i++) {
                c = s.charCodeAt(i);
                hash = ((hash << 5) - hash) + c;
                hash = hash & hash; // Convert to 32bit integer
            }
            return hash;
        },
        detach: function () {
            this.list = this.hash = [];
        },
        register: function (fn) {
            var h = this.hashCode(fn);
            if ($.inArray(h, this.hash) === -1) {
                this.list.push(fn);
                this.hash.push(h);
            }
        },
        execute: function () {
            var self = this,
                    length = self.list.length;
            for (var i = 0; i < length; i++) {
                try {
                    self.list[i].apply(document, [$]);
                }
                catch (e) {
                    throw e;
                }
            }
            ;
        }
    };
    /** register function */
    $.fn.ready = function (fn) {
        $.readyFn.register(fn);
        $.ready.promise().done(fn);
        return this;
    };

    ThemifyAjax = {
        trigger: false,
        builder_is_init: false,
        is_turn_on: false,
        is_playing: false,
        load_once: false,
        player: null,
        init: function () {

            $(document)
                    .on('click', 'a[href]:not(.themify_lightbox):not(.themify-lightbox)', this.get)
                    .on('submit', '#searchform,form.woocommerce-ordering,form.cart', this.get)
                    .on('submit', '#commentform', this.comment);
            $(window).on('popstate', this.get);
            var self = this;
            $('body').on('builderiframeloaded.themify', function () {
                self.is_playing = self.is_turn_on = true;
                self.pause();
                $(document)
                        .off('click', 'a[href]:not(.themify_lightbox):not(.themify-lightbox)', self.get)
                        .off('submit', '#searchform,form.woocommerce-ordering,form.cart', self.get)
                        .off('submit', '#commentform', self.comment);
                $(window).off('popstate', self.get);
            });
            if ('undefined' != typeof mejs && mejs.players) {
                this.load_once = false;
                this.player = this.getPlayer();
                if (!this.player) {
                    $('#footer-player').find('audio').on('canplay', function () {
                        $('#footer-player').find('audio').off('canplay');
                        ThemifyAjax.InitAudioEvents();
                    });
                }
                else {
                    this.InitAudioEvents();
                }
            }
        },
        progress: function (hide, min, max) {
            var progress = $('#themify-progress'),
                    percnet = hide ? 100 : Math.floor(Math.random() * (max - min + 1)) + min;
            if (percnet <= 85 || hide) {
                progress.animate({
                    width: percnet + '%'
                }, 300, function () {
                    if (!hide) {
                        ThemifyAjax.progress(false, percnet + 5, (max + 15));
                    }
                    else {
                        $('body').removeClass('themify-loading');
                    }
                });
            }
        },
        InitAudioEvents: function () {
            var self = ThemifyAjax;
            self.player = self.getPlayer();
            self.is_playing = self.player ? !self.player.paused : false;
            if (self.player) {
                $(document).on('mfpOpen', self.InitVideo);
                $('body').on('themiboxloaded', self.InitAudio)
                        .on('themiboxclosed', self.RemoveAudio);

                self.InitVideo();
                self.RemoveAudio();
                self.InitAudio();
                self.onPlay();
                self.onPause();
            }
        },
        getPlayer: function () {
            if (!this.player) {
                var id = 'undefined' != typeof mejs && mejs.players ? $('#footer-player').find('.mejs-container').prop('id') : false;
                if (id && mejs.players[id]) {
                    this.player = mejs.players[id];
                }
            }
            return this.player;
        },
        InitAudio: function (e) {
            if (ThemifyAjax.is_playing && $('audio').length > 1) {
                $('audio').each(function () {
                    if ($(this).closest('#footer-player').length === 0) {
                        $(this).on('canplay', function () {
                            var isPlaying = false;
                            $(this).off('canplay');
                            this.addEventListener('pause', function (e) {
                                setTimeout(function () {
                                    if ( isPlaying ) ThemifyAjax.play();
                                }, 50);
                            });
                            this.addEventListener('play', function (e) {
                                isPlaying = $('#footer-player .mejs-playpause-button').hasClass( 'mejs-pause' );
                            });

                            this.addEventListener('ended', function (e) {
                                ThemifyAjax.play();
                            });
                        });
                    }
                });
            }
        },
        RemoveAudio: function (e) {
            if (Object.keys(mejs.players).length > 1) {
                var player = ThemifyAjax.getPlayer();
                for (var i in mejs.players) {
                    if (player.id !== mejs.players[i].id && $('#' + mejs.players[i].id).length === 0) {
                        mejs.players[i].remove();
                    }
                }
            }
            if (e && e.type === 'themiboxclosed') {
                ThemifyAjax.play();
            }
        },
        InitVideo: function (e) {

            if (ThemifyAjax.is_playing) {
                var is_video = false;

                if ( ! e ) {
                    $( document ).on( 'videoBuilderFreeze', function( e ) {
                        if( ThemifyAjax.player.domNode.dataset.isPlaying == 1 ) {
                            ThemifyAjax.play();
                            ThemifyAjax.player.domNode.dataset.isPlaying = 0;
                        }
                    } );
                }
                
                if (is_video && e && e.type === 'mfpOpen' && !ThemifyAjax.load_once) {
                    ThemifyAjax.load_once = true;
                    $(document).on('mfpClose', ThemifyAjax.play);
                }
            }
            else {
                $(document).off('mfpClose', ThemifyAjax.play);
                ThemifyAjax.load_once = false;
            }
        },
        onPlay: function () {
            ThemifyAjax.getPlayer().media.addEventListener('playing', function (e) {
                ThemifyAjax.is_playing = true;
            });
        },
        onPause: function () {
            ThemifyAjax.getPlayer().media.addEventListener('pause', function (e) {
                ThemifyAjax.is_playing = false;
            });
        },
        play: function () {
            if ( !ThemifyAjax.is_playing && ThemifyAjax.getPlayer() ) {
                ThemifyAjax.getPlayer().play();
            }
        },
        pause: function () {
            if ( ThemifyAjax.is_playing && ThemifyAjax.getPlayer() ) {
                ThemifyAjax.getPlayer().pause();
            }
        },
        checkVideo: function (check) {
            var ret = false;
            $('iframe').each(function () {
                var src = $(this).prop('src');
                if ((check === 'youtube' && (src.indexOf('youtube.com') !== -1 || src.indexOf('youtu.be') !== -1)) || (check === 'vimeo' && src.indexOf('vimeo.com') !== -1)) {
                    ret = true;
                    return false;
                }
            });
            return ret;
        },
        checkInlineHash: function (url) {
            if (url.indexOf('#') !== -1) {
                var a = document.createElement("a");
                a.href = url;
                return a.pathname === window.location.pathname;
            }
            return false;
        },
        get: function (e) {
            if (ThemifyAjax.is_turn_on) {
                return true;
            }
            var is_submit = e.type === 'submit',
                    url = is_submit ? $(this).attr('action') : $(this).attr('href'),
                    site_url = $.trim(themifyScript.site_url.replace('http://', '').replace('https://', ''), '/');

            if (e && e.type === 'popstate') {
                var state = e.originalEvent.state;
                if (state && state.path) {
                    url = state.path;
                }
            }

            var matcher = new RegExp('\\.(' + themifyScript.ext + ')$', "ig");
            if (is_submit || (url && $.trim(url, '/').indexOf(site_url) !== -1 && $(this).prop('rel') !== 'nofollow' && $(this).prop('target') !== '_blank' && !$(this).prop('onclick') && !matcher.test(url))) {
                for (var i in themifyScript.disable_link) {
                    if (url.indexOf(themifyScript.disable_link[i]) !== -1) {
                        return true;
                    }
                }
                e.preventDefault();
                e.stopPropagation();
                var self = ThemifyAjax;

                if (e.type === 'click' && (url === window.location.href || url === '#' || self.checkInlineHash(url))) {
                    return false;
                }
                var loading = $('body'),
                        load = is_submit ? !$(this).hasClass('cart') && !$(this).hasClass('woocommerce-ordering') : true,
                        container = load ? $('#pagewrap') : $('#content'),
                        is_post = is_submit ? $(this).attr('method').toLowerCase() === 'post' : false,
                        url = is_submit && !url ? location.protocol + '//' + location.host + location.pathname : url,
                        original_data = is_submit && !is_post ? url + '?' + $(this).serialize() : false,
                        data = is_submit ? ThemifyAjax.formFieldsToObject($(this).serializeArray()) : {};
                data['themify_ajax'] = 1;
                data['themify_load'] = load ? 1 : 0;

                $.ajax({
                    url: url,
                    data: data,
                    type: is_post ? 'POST' : 'GET',
                    global: false,
                    beforeSend: function () {
                        $('.close-lightbox').trigger('click');
                        loading.addClass('themify-loading');
                        $('#themify-progress').width(0);
                        ThemifyAjax.progress(false, 25, 45);
                    },
                    error: function () {
                        loading.removeClass('themify-loading');
                    },
                    success: function (resp) {

                        var dom = $(document.createElement("html"));
                        dom[0].innerHTML = resp;
                        var title = $('title', dom).html(),
                                admin_bar = $('#wpadminbar', dom);
                        $('#body', dom).css('opacity', 0);
                        if (load) {
                            $('#wpfooter').replaceWith($('#wpfooter', dom));
                            self.includeCssFiles();
                            self.includeStyle($('style', dom));
                            self.includeJsFiles();
                            loading.prop('class', $("body", dom).prop('class') + ' themify-loading');
                            themifyMobileMenuTrigger();
                            $('title').html(title);
                            if (admin_bar.length > 0) {
                                $('#wpadminbar').replaceWith(admin_bar);
                            }
                            container.html($('#pagewrap', dom).html());
                        }
                        else {
                            container.html($('#content', dom).html());
                        }
                        $(window).off('hashchange resize scroll click change touchstart.touchScroll touchmove.touchScroll popstate pushState beforeunload');
                        $(document).off();
                        $('body').off().data('plugin_themifyScrollHighlight', '');
                        $(window).resize(themifyMobileMenuTrigger);
                        $("html, body").animate({scrollTop: 0}, 'fast', function () {
                            $('#body').stop(true).animate({'opacity': 1}, 600, function () {
                                $('.themify_builder_front_panel').remove();
                                var playlist = $('.wp-playlist');
                                playlist.removeClass('wp-playlist');
                                self.trigger = true;

                                $(document).on('themify_builder_loaded', function () {
                                    self.builder_is_init = true;
                                });
                                if (original_data) {
                                    url = original_data;
                                }
                                if (e.type !== 'popstate') {
                                    history.pushState({path: url}, title, url);
                                }
                                else {
                                    history.replaceState({path: url}, title, url);
                                }
                                $.readyFn.execute();
                                if (!self.builder_is_init && typeof ThemifyBuilderModuleJs !== 'undefined') {
                                    ThemifyBuilderModuleJs.init();
                                    self.builder_is_init = false;
                                }
                                Themify.triggerEvent(window, 'load');
                                self.trigger = false;
                                playlist.addClass('wp-playlist');
                                ThemifyAjax.progress(true);
                            });
                        });
                    }
                });
            }
        },
        checkfile: function (id, src, type) {
            return type === 'style' ? (src.indexOf('.css') > 0 && $('link#' + id).length === 0 && $('link[href*="' + src + '"]').length === 0) : src.indexOf('.js') > 0 && $('script#' + id).length === 0 && $('script[src*="' + src + '"]').length === 0;
        },
        includeJsFiles: function (files, i) {
            var queue = files ? files : themify_js_files.queue,
                    length = queue.length,
                    i = i > 0 ? i : 0,
                    registered = themify_js_files.registered;
            if (i < length) {
                if (registered[queue[i]] && registered[queue[i]].src && ThemifyAjax.checkfile(registered[queue[i]].handle, registered[queue[i]].src)) {
                    registered[queue[i]].deps = $.grep(registered[queue[i]].deps, function (value) {
                        return value !== 'jquery';
                    });
                    if (registered[queue[i]].deps.length > 0) {
                        ThemifyAjax.includeJsFiles(registered[queue[i]].deps, 0);
                    }
                    if (registered[queue[i]].extra.data) {
                        var s = document.createElement('script');
                        s.type = 'text/javascript';
                        s.text = registered[queue[i]].extra.data;
                        s.id = registered[queue[i]].handle;
                        var t = document.getElementsByTagName('script')[0];
                        t.parentNode.insertBefore(s, t);
                    }
                    Themify.LoadAsync(registered[queue[i]].src, function () {
                        setTimeout(function () {
                            ThemifyAjax.includeJsFiles(files, (i + 1));
                        }, 100);
                    }, registered[queue[i]].ver, null);

                }
                else {
                    ++i;
                    ThemifyAjax.includeJsFiles(files, i);
                }
            }
        },
        includeCssFiles: function (files) {
            var queue = files ? files : themify_css_files.queue,
                    length = $.isArray(queue) ? queue.length : Object.keys(queue).length,
                    registered = themify_css_files.registered;
            for (var i = 0; i < length; i++) {
                if (registered[queue[i]] && registered[queue[i]].src && ThemifyAjax.checkfile(registered[queue[i]].handle, registered[queue[i]].src, 'style')) {
                    if (registered[queue[i]].deps.length > 0) {
                        ThemifyAjax.includeCssFiles(registered[queue[i]].deps);
                    }
                    Themify.LoadCss(registered[queue[i]].src, registered[queue[i]].ver, null, registered[queue[i]].args);
                }
            }
        },
        includeStyle: function (styles) {
            $('style').remove();
            $('head').append(styles);
        },
        formFieldsToObject: function (fields) {
            var _arr = {};
            for (var i = 0; i < fields.length; i++) {
                var field = fields[ i ];

                if (!_arr.hasOwnProperty(field.name)) {
                    _arr[ field.name ] = field.value;
                }
                else {
                    if (!_arr[ field.name ] instanceof Array)
                        _arr[ field.name ] = [_arr[ field.name ]];

                    _arr[ field.name ].push(field.value);
                }
            }

            return _arr;
        },
        comment: function (e) {

            e.preventDefault();
            var el = $(this),
                    is_review = $('#reviews').length > 0,
                    wrapper = is_review ? $('#reviews') : $('#comments');
            $.ajax({
                url: themifyScript.ajax_url,
                type: 'POST',
                dataType: "json",
                global: false,
                data: {'data': ThemifyAjax.formFieldsToObject(el.serializeArray()), 'action': 'themify_comment'},
                beforeSend: function () {
                    $('.themify-input-error').removeClass('themify-input-error');
                    $('.themify-comment-error').remove();
                    if ($('.spinner').length === 0) {
                        wrapper.append('<div class="spinner"><div class="spinner-icon"></div></div>')
                    }
                    $('body').addClass('themify-loading');
                },
                complete: function () {
                    $('body').removeClass('themify-loading');
                },
                success: function (resp) {
                    if (resp) {
                        if (resp.error) {
                            el.find('input[type="submit"]').after('<div class="themify-comment-error">' + resp.data.val + '</div>');
                            if (resp.data.id) {
                                var fields = $.trim(resp.data.id).split(',');
                                for (var i = 0; i < fields.length; i++) {
                                    $('#' + fields[i], el).addClass('themify-input-error');
                                }
                            }
                        }
                        else if (resp.success) {
                            wrapper.replaceWith(resp.data);
                            if (is_review) {
                                $(' #rating').trigger('init');
                                $(' .reviews_tab a').trigger('click');
                            }
                        }
                    }
                }
            });

        }
    };
    $(document).ready(function () {
        ThemifyAjax.init();
    });
    history.replaceState({path: window.location.href}, '');

})(jQuery);