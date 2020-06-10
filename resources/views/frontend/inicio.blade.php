@extends('layouts.frontend.index')

@section('slider')
<div class="mfn-main-slider" id="mfn-rev-slider">
    <div id="slider_inicio_wrapper" class="rev_slider_wrapper fullwidthbanner-container flv_rev_14">
        <div id="slider_inicio" class="rev_slider fullwidthabanner flv_rev_13">
            <ul>
                <li data-transition="fade" data-slotamount="7" data-masterspeed="300" data-thumb="{{ asset('fe/images/slide-home-thumb.jpg') }}" data-saveperformance="off">
                    <img src="{{ asset('fe/images/slide-home-bg.jpg') }}" alt="slide-home-bg" data-bgposition="center top" data-bgfit="cover" data-bgrepeat="no-repeat">
                    <div class="tp-caption mfnrs_home sft tp-resizeme flv_rev_2" data-x="left" data-hoffset="50" data-y="top" data-voffset="70" data-speed="500" data-start="1000" data-easing="Power3.easeInOut" data-splitin="none" data-splitout="none" data-elementdelay="0.1" data-endelementdelay="0.1" data-endspeed="300">
                        D-TEC 0016/13
                    </div>
                    <div style="font-size: 1.6rem;" class="tp-caption mfnrs_home_tiny sfb tp-resizeme flv_rev_10" data-x="left" data-hoffset="50" data-y="top" data-voffset="130" data-speed="500" data-start="1500" data-easing="Power3.easeInOut" data-splitin="none" data-splitout="none" data-elementdelay="0.1" data-endelementdelay="0.1" data-endspeed="300">
                        Licenciatura en Sistemas de Información
                    </div>
                    <div style="font-size: 1.6rem;" class="tp-caption mfnrs_home_tiny sfb tp-resizeme flv_rev_10" data-x="left" data-hoffset="50" data-y="top" data-voffset="165" data-speed="500" data-start="2000" data-easing="Power3.easeInOut" data-splitin="none" data-splitout="none" data-elementdelay="0.1" data-endelementdelay="0.1" data-endspeed="300">
                        <strong>UNSE</strong>
                    </div>
                </li>
                <li data-transition="fade" data-slotamount="7" data-masterspeed="300" data-thumb="{{ asset('fe/images/slide-home-2-thumb.jpg') }}" data-saveperformance="off">
                    <img src="{{ asset('fe/images/slide-home-2-bg.jpg') }}" alt="slide-home-2-bg" data-bgposition="center top" data-bgfit="cover" data-bgrepeat="no-repeat">
                    <div class="tp-caption mfnrs_home sft tp-resizeme flv_rev_2" data-x="left" data-hoffset="50" data-y="top" data-voffset="70" data-speed="500" data-start="1000" data-easing="Power3.easeInOut" data-splitin="none" data-splitout="none" data-elementdelay="0.1" data-endelementdelay="0.1" data-endspeed="300">
                        Trabajos de campo en
                    </div>
                    <div style="font-size: 1.6rem;" class="tp-caption mfnrs_home_tiny sfb tp-resizeme flv_rev_10" data-x="left" data-hoffset="50" data-y="top" data-voffset="130" data-speed="500" data-start="1500" data-easing="Power3.easeInOut" data-splitin="none" data-splitout="none" data-elementdelay="0.1" data-endelementdelay="0.1" data-endspeed="300">
                        Colonia Jaime
                    </div>
                    <div style="font-size: 1.6rem;" class="tp-caption mfnrs_home_tiny sfb tp-resizeme flv_rev_10" data-x="left" data-hoffset="50" data-y="top" data-voffset="165" data-speed="500" data-start="2000" data-easing="Power3.easeInOut" data-splitin="none" data-splitout="none" data-elementdelay="0.1" data-endelementdelay="0.1" data-endspeed="300">
                        El Polear
                    </div>
                </li>
            </ul>
            <div class="tp-bannertimer tp-bottom flv_vis_hid"></div>
        </div>
    </div>
</div>
@endsection

@section('content')
<div id="Content">
    <div class="content_wrapper clearfix">
        <div class="sections_group">
            <div class="entry-content">
                <div class="section flv_sections_4">
                    <div class="section_wrapper clearfix">
                        <div class="items_group clearfix">
                            
                            <!-- Page Title-->
                            <!-- One full width row-->
                            <div class="column one column_fancy_heading">
                                <div class="fancy_heading fancy_heading_icon">
                                    <!-- Animated area -->
                                    <div class="animate" data-anim-type="zoomInLeftLarge">
                                        <span class="icon_top"><i class="icon-picture"></i></span>
                                        <h2 class="title">Imágenes de informes</h2>
                                        <div class="inside">
                                            <span class="big">Durante la realización de los informes de campo, se tomaron fotografías que muestran la evolución en los proyectos supervisados...</span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- One full width row-->
                            <div class="column one column_slider">
                                <!-- Slider Content -->
                                <div class="content_slider ">
                                    <ul class="content_slider_ul">

                                        @foreach ($imagenes as $r)

                                        <li class="content_slider_li_1">
                                            <a><img width="890" height="470" src="{{ url('image/original/'.$r->id.'_'.$r->imagen) }}" class="scale-with-grid wp-post-image" alt="Imagen" />
                                            </a>
                                        </li>

                                        @endforeach

                                    </ul><a class="button button_js slider_prev" href="#"><span class="button_icon"><i class="icon-left-open-big"></i></span></a><a class="button button_js slider_next" href="#"><span class="button_icon"><i class="icon-right-open-big"></i></span></a>
                                    <div class="slider_pagination"></div>
                                </div>
                            </div>

                            <!-- One full width row-->
                            <div class="column one column_column">
                                <div class="column_attr ">
                                    <div class="aligncenter">
                                        <a class="button button_left button_theme button_js" href="{{ route('login') }}"><span class="button_icon"><i class="icon-user"></i></span><span class="button_label">Ingresar al sistema</span></a>
                                    </div>
                                </div>
                            </div>

                            <!-- Page devider -->
                            <!-- One full width row-->
                            <div class="column one column_divider">
                                <hr class="flv_margin_b_35" />
                            </div>

                            <!-- Page Title-->
                            <!-- One full width row-->
                            <div class="column one column_fancy_heading">
                                <div class="fancy_heading fancy_heading_icon">
                                    <!-- Animated area -->
                                    <div class="animate" data-anim-type="zoomInLeftLarge">
                                        <h2 class="title">Proyecto D-TEC 0016/13 <span id="thematic-websites" class="themecolor">UNSE</span></h2>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('js_slider')
<script src="{{ asset('fe/plugins/rs-plugin/js/jquery.themepunch.tools.min.js') }}"></script>
<script src="{{ asset('fe/plugins/rs-plugin/js/jquery.themepunch.revolution.min.js') }}"></script>

<script src="{{ asset('fe/plugins/rs-plugin/js/extensions/revolution.extension.video.min.js') }}"></script>
<script src="{{ asset('fe/plugins/rs-plugin/js/extensions/revolution.extension.slideanims.min.js') }}"></script>
<script src="{{ asset('fe/plugins/rs-plugin/js/extensions/revolution.extension.actions.min.js') }}"></script>
<script src="{{ asset('fe/plugins/rs-plugin/js/extensions/revolution.extension.layeranimation.min.js') }}"></script>
<script src="{{ asset('fe/plugins/rs-plugin/js/extensions/revolution.extension.kenburn.min.js') }}"></script>
<script src="{{ asset('fe/plugins/rs-plugin/js/extensions/revolution.extension.navigation.min.js') }}"></script>
<script src="{{ asset('fe/plugins/rs-plugin/js/extensions/revolution.extension.migration.min.js') }}"></script>
<script src="{{ asset('fe/plugins/rs-plugin/js/extensions/revolution.extension.parallax.min.js') }}"></script>

<script>
    var tpj = jQuery;
    tpj.noConflict();
    var revapi34;
    tpj(document).ready(function() {
        if (tpj("#slider_inicio").revolution == undefined) {
            revslider_showDoubleJqueryError("#slider_inicio");
        } else {
            revapi34 = tpj("#slider_inicio").show().revolution({
                sliderType: "standard",

                sliderLayout: "auto",
                dottedOverlay: "none",
                delay: 5000,
                navigation: {
                    keyboardNavigation: "off",
                    keyboard_direction: "horizontal",
                    mouseScrollNavigation: "off",
                    onHoverStop: "on",
                    touch: {
                        touchenabled: "on",
                        swipe_threshold: 0.7,
                        swipe_min_touches: 1,
                        swipe_direction: "horizontal",
                        drag_block_vertical: false
                    },
                    arrows: {
                        style: "uranus",
                        enable: true,
                        hide_onmobile: false,
                        hide_onleave: false,
                        tmp: '',
                        left: {
                            h_align: "right",
                            v_align: "bottom",
                            h_offset: 90,
                            v_offset: 40
                        },
                        right: {
                            h_align: "right",
                            v_align: "bottom",
                            h_offset: 40,
                            v_offset: 40
                        }
                    },
                    thumbnails: {
                        style: "hesperiden",
                        enable: false,
                        width: 200,
                        height: 80,
                        min_width: 100,
                        wrapper_padding: 5,
                        wrapper_color: "transparent",
                        wrapper_opacity: "1",
                        tmp: '<span class="tp-thumb-image"></span><span class="tp-thumb-title">Slide</span>',
                        visibleAmount: 3,
                        hide_onmobile: true,
                        hide_under: 0,
                        hide_onleave: false,
                        direction: "horizontal",
                        span: false,
                        position: "inner",
                        space: 5,
                        h_align: "left",
                        v_align: "bottom",
                        h_offset: 40,
                        v_offset: 40
                    }
                },
                gridwidth: 1180,
                gridheight: 500,
                lazyType: "none",
                shadow: 0,
                spinner: "spinner3",
                stopLoop: "off",
                stopAfterLoops: -1,
                stopAtSlide: -1,
                shuffle: "off",
                autoHeight: "off",
                disableProgressBar: "on",
                hideThumbsOnMobile: "on",
                hideSliderAtLimit: 0,
                hideCaptionAtLimit: 0,
                hideAllCaptionAtLilmit: 0,
                startWithSlide: 0,
                debugMode: false,
                fallbacks: {
                    simplifyAll: "on",
                    nextSlideOnWindowFocus: "off",
                    disableFocusListener: "off",
                }
            });
        }
    });
</script>
@endsection