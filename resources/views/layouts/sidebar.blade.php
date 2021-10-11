<!-- ========== Left Sidebar Start ========== -->
<div class="vertical-menu">

    <!-- LOGO -->
    <div class="navbar-brand-box">
        <a href="index" class="logo logo-dark">
            <span class="logo-sm">
                <img src="{{ URL::asset('/assets/logo/auth-logo.png') }}" alt="" height="28">
            </span>
            <span class="logo-lg">
                <img src="{{ URL::asset('/assets/logo/auth-logo.png') }}" alt="" height="28">
            </span>
        </a>

        <a href="index" class="logo logo-light">
            <span class="logo-sm">
                <img src="{{ URL::asset('/assets/logo/auth-logo.png') }}" alt="" height="28">
            </span>
            <span class="logo-lg">
                <img src="{{ URL::asset('/assets/logo/auth-logo.png') }}" alt="" height="28">
            </span>
        </a>
    </div>

    <button type="button" class="btn btn-sm px-3 font-size-16 header-item waves-effect vertical-menu-btn">
        <i class="fa fa-fw fa-bars"></i>
    </button>

    <div data-simplebar class="sidebar-menu-scroll">

        <!--- Sidemenu -->
        <div id="sidebar-menu">
            <!-- Left Menu Start -->
            <ul class="metismenu list-unstyled" id="side-menu">
                <li class="menu-title">@lang('translation.Menu')</li>

                <li>
                    <a href="{{route('index')}}" class="waves-effect">
                        
                        <i class="icon nav-icon" data-feather="home"></i>
                        <span class="menu-item">@lang('translation.Dashboard')</span>
                    </a>
                </li>
                @if(permission('client'))
                @if(permission('manager'))
                <li  class="{{ Request::is('all-users*') || Request::is('emp*') || Request::is('client*') ? 'mm-active' : ''  }}">
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="icon nav-icon" data-feather="user"></i>
                        <span class="menu-item">@lang('general.User_List') </span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        @if(permission('admin') )
                        <li><a href="{{route('all-users.index')}}" class="{{ Request::is('all-users*')? 'active': '' }}" >@lang('general.All_Users') </a></li>
                        @endif
                        <li><a href="{{route('emp.index')}}" class="{{ Request::is('emp*')? 'active': '' }}" >@lang('general.Employee')</a></li>
                        <li><a href="{{route('client.index')}}" class="{{ Request::is('client*')? 'active': '' }}" >@lang('general.Clients')</a></li>
                    </ul>
                </li>
                @endif

                
                <li class="{{Request::is('digital*') ? 'mm-active' : ''}}">
                    <a href="{{route('digital.index')}}" class=" waves-effect">
                        <img src="{{asset('assets/logo/menu/digital_marketing.png')}}" width="17"/>
                        <span class="menu-item"> @lang('general.Digital Marketing')</span>
                    </a>
                   
                </li>
                @endif

                

                <li class="{{Request::is('social-media*') ? 'mm-active' : ''}}">
                    <a href="{{route('social-media.index')}}" class="waves-effect">
                        <img src="{{asset('assets/logo/menu/social_media.png')}}" width="17"/>
                        <span class="menu-item"> @lang('general.Social Media')</span>
                    </a>
                </li> 

                <li class="{{Request::is('creative*') ? 'mm-active' : ''}}">
                    <a href="{{route('creative.index')}}" class="waves-effect">
                        <img src="{{asset('assets/logo/menu/creative.png')}}" width="17"/>
                        <span class="menu-item"> @lang('general.Creative')</span>
                    </a>
                </li> 

                <li class="{{Request::is('report*') ? 'mm-active' : ''}}">
                    <a href="{{route('report.index')}}" class="waves-effect">
                        <img src="{{asset('assets/logo/menu/additional_report.png')}}" width="16"/>
                        
                        <span class="menu-item"> @lang('general.ADDITIONAL REPORT')</span>
                    </a>
                </li> 
                <li class="{{Request::is('media*') ? 'mm-active' : ''}}">
                    <a href="{{route('media.index')}}" class="waves-effect">
                       <img src="{{asset('assets/logo/menu/media.png')}}" width="17"/>
                        <span class="menu-item"> @lang('general.media')</span>
                    </a>
                </li> 

                <li class="{{Request::is('invoice*') ? 'mm-active' : ''}}">
                    <a href="{{route('invoice.index')}}" class="waves-effect">
                        <img src="{{asset('assets/logo/menu/invoice.png')}}" width="17"/>
                        <span class="menu-item"> @lang('general.Invoice')</span>
                    </a>
                </li> 

                <li class="{{Request::is('notification*') ? 'mm-active' : ''}}">
                    <a href="{{route('notification.index')}}" class="waves-effect">
                        <i class="icon nav-icon" data-feather="bell"></i>
                        <span class="menu-item"> @lang('general.Notification')</span>
                    </a>
                </li> 

                @if(permission('manager'))
                <li class="{{Request::is('ad*') ? 'mm-active' : ''}}">
                    <a href="{{route('ad.index')}}" class="waves-effect">
                        <i class="icon nav-icon" data-feather="bell"></i>
                        <span class="menu-item"> @lang('general.ad')</span>
                    </a>
                </li> 
                @endif

                

                {{-- <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="icon nav-icon" data-feather="layout"></i>
                        <span class="menu-item">@lang('translation.Layouts')</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="layouts-horizontal">@lang('translation.Horizontal')</a></li>
                        <li><a href="layouts-light-sidebar">@lang('translation.Light_Sidebar')</a></li>
                        <li><a href="layouts-compact-sidebar">@lang('translation.Compact_Sidebar')</a></li>
                        <li><a href="layouts-icon-sidebar">@lang('translation.Icon_Sidebar')</a></li>
                        <li><a href="layouts-boxed">@lang('translation.Boxed_Width')</a></li>
                        <li><a href="layouts-preloader">@lang('translation.Preloader')</a></li>
                        <li><a href="layouts-colored-sidebar">@lang('translation.Colored_Sidebar')</a></li>
                        <li><a href="layouts-scrollable">@lang('translation.Scrollable')</a></li>
                    </ul>
                </li>

                <li class="menu-title">@lang('translation.Apps')</li>

                <li>
                    <a href="calendar" class="waves-effect">
                        <i class="icon nav-icon" data-feather="calendar"></i>
                        <span class="menu-item">@lang('translation.Calendar')</span>
                    </a>
                </li>

                <li>
                    <a href="chat" class=" waves-effect">
                        <i class="icon nav-icon" data-feather="message-square"></i>
                        <span class="badge badge-pill badge-success float-right">@lang('translation.New')</span>
                        <span class="menu-item">@lang('translation.Chat')</span>
                    </a>
                </li>

                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="icon nav-icon" data-feather="shopping-bag"></i>
                        <span class="menu-item">@lang('translation.Ecommerce')</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="ecommerce-products">@lang('translation.Products')</a></li>
                        <li><a href="ecommerce-product-detail">@lang('translation.Product_Detail')</a></li>
                        <li><a href="ecommerce-orders">@lang('translation.Orders')</a></li>
                        <li><a href="ecommerce-customers">@lang('translation.Customers')</a></li>
                        <li><a href="ecommerce-cart">@lang('translation.Cart')</a></li>
                        <li><a href="ecommerce-checkout">@lang('translation.Checkout')</a></li>
                        <li><a href="ecommerce-shops">@lang('translation.Shops')</a></li>
                        <li><a href="ecommerce-add-product">@lang('translation.Add_Product')</a></li>
                    </ul>
                </li>

                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="icon nav-icon" data-feather="mail"></i>
                        <span class="menu-item">@lang('translation.Email')</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="email-inbox">@lang('translation.Inbox')</a></li>
                        <li><a href="email-read">@lang('translation.Read_Email')</a></li>
                    </ul>
                </li>

                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="icon nav-icon" data-feather="file"></i>
                        <span class="menu-item">@lang('translation.Invoices')</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="invoices-list">@lang('translation.Invoice_List')</a></li>
                        <li><a href="invoices-detail">@lang('translation.Invoice_Detail')</a></li>
                    </ul>
                </li>

                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="icon nav-icon" data-feather="book"></i>
                        <span class="menu-item">@lang('translation.Contacts')</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="contacts-grid">@lang('translation.User_Grid')</a></li>
                        <li><a href="contacts-list">@lang('translation.User_List')</a></li>
                        <li><a href="contacts-profile">@lang('translation.Profile')</a></li>
                    </ul>
                </li>

                <li class="menu-title">@lang('translation.Pages')</li>

                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="icon nav-icon" data-feather="user"></i>
                        <span class="menu-item">@lang('translation.Authentication')</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="auth-login">@lang('translation.Login')</a></li>
                        <li><a href="auth-register">@lang('translation.Register')</a></li>
                        <li><a href="auth-recoverpw">@lang('translation.Recover_Password')</a></li>
                        <li><a href="auth-lock-screen">@lang('translation.Lock_Screen')</a></li>
                    </ul>
                </li>

                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="icon nav-icon" data-feather="file-text"></i>
                        <span class="menu-item">@lang('translation.Utility')</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="pages-starter">@lang('translation.Starter_Page')</a></li>
                        <li><a href="pages-maintenance">@lang('translation.Maintenance')</a></li>
                        <li><a href="pages-comingsoon">@lang('translation.Coming_Soon')</a></li>
                        <li><a href="pages-timeline">@lang('translation.Timeline')</a></li>
                        <li><a href="pages-faqs">@lang('translation.FAQs')</a></li>
                        <li><a href="pages-pricing">@lang('translation.Pricing')</a></li>
                        <li><a href="pages-404">@lang('translation.Error_404')</a></li>
                        <li><a href="pages-500">@lang('translation.Error_500')</a></li>
                    </ul>
                </li>

                <li class="menu-title">@lang('translation.Components')</li>

                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="icon nav-icon" data-feather="gift"></i>
                        <span class="menu-item">@lang('translation.UI_Elements')</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="ui-alerts">@lang('translation.Alerts')</a></li>
                        <li><a href="ui-buttons">@lang('translation.Buttons')</a></li>
                        <li><a href="ui-cards">@lang('translation.Cards')</a></li>
                        <li><a href="ui-carousel">@lang('translation.Carousel')</a></li>
                        <li><a href="ui-dropdowns">@lang('translation.Dropdowns')</a></li>
                        <li><a href="ui-grid">@lang('translation.Grid')</a></li>
                        <li><a href="ui-images">@lang('translation.Images')</a></li>
                        <li><a href="ui-lightbox">@lang('translation.Lightbox')</a></li>
                        <li><a href="ui-modals">@lang('translation.Modals')</a></li>
                        <li><a href="ui-rangeslider">@lang('translation.Range_Slider')</a></li>
                        <li><a href="ui-session-timeout">@lang('translation.Session_Timeout')</a></li>
                        <li><a href="ui-progressbars">@lang('translation.Progress_Bars')</a></li>
                        <li><a href="ui-sweet-alert">@lang('translation.Sweet_Alert')</a></li>
                        <li><a href="ui-tabs-accordions">@lang('translation.Tabs_Accordions')</a></li>
                        <li><a href="ui-typography">@lang('translation.Typography')</a></li>
                        <li><a href="ui-video">@lang('translation.Video')</a></li>
                        <li><a href="ui-general">@lang('translation.General')</a></li>
                        <li><a href="ui-colors">@lang('translation.Colors')</a></li>
                        <li><a href="ui-rating">@lang('translation.Rating')</a></li>
                        <li><a href="ui-notifications">@lang('translation.Notifications')</a></li>
                    </ul>
                </li>

                <li>
                    <a href="javascript: void(0);" class="waves-effect">
                        <i class="icon nav-icon" data-feather="edit-3"></i>
                        <span class="badge badge-pill badge-info float-right">9</span>
                        <span class="menu-item">@lang('translation.Forms')</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="form-elements">@lang('translation.Basic_Elements')</a></li>
                        <li><a href="form-validation">@lang('translation.Validation')</a></li>
                        <li><a href="form-advanced">@lang('translation.Advanced_Plugins')</a></li>
                        <li><a href="form-editors">@lang('translation.Editors')</a></li>
                        <li><a href="form-uploads">@lang('translation.File_Upload')</a></li>
                        <li><a href="form-xeditable">@lang('translation.Xeditable')</a></li>
                        <li><a href="form-repeater">@lang('translation.Repeater')</a></li>
                        <li><a href="form-wizard">@lang('translation.Wizard')</a></li>
                        <li><a href="form-mask">@lang('translation.Mask')</a></li>
                    </ul>
                </li>

                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="icon nav-icon" data-feather="database"></i>
                        <span class="menu-item">@lang('translation.Tables')</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="tables-basic">@lang('translation.Bootstrap_Basic')</a></li>
                        <li><a href="tables-datatable">@lang('translation.Datatables')</a></li>
                        <li><a href="tables-responsive">@lang('translation.Responsive')</a></li>
                        <li><a href="tables-editable">@lang('translation.Editable')</a></li>
                    </ul>
                </li>

                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="icon nav-icon" data-feather="pie-chart"></i>
                        <span class="menu-item">@lang('translation.Charts')</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="charts-apex">@lang('translation.Apex')</a></li>
                        <li><a href="charts-chartjs">@lang('translation.Chartjs')</a></li>
                        <li><a href="charts-flot">@lang('translation.Flot')</a></li>
                        <li><a href="charts-knob">@lang('translation.Jquery_Knob')</a></li>
                        <li><a href="charts-sparkline">@lang('translation.Sparkline')</a></li>
                    </ul>
                </li>

                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="icon nav-icon" data-feather="archive"></i>
                        <span class="menu-item">@lang('translation.Icons')</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="icons-unicons">Unicons</a></li>
                        <li><a href="icons-feathericons">Feather icons</a></li>
                        <li><a href="icons-boxicons">Boxicons</a></li>
                        <li><a href="icons-materialdesign">Material Design</a></li>
                        <li><a href="icons-dripicons">Dripicons</a></li>
                        <li><a href="icons-fontawesome">Font Awesome</a></li>
                    </ul>
                </li>

                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="icon nav-icon" data-feather="map-pin"></i>
                        <span class="menu-item">@lang('translation.Maps')</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="maps-google">@lang('translation.Google')</a></li>
                        <li><a href="maps-vector">@lang('translation.Vector')</a></li>
                        <li><a href="maps-leaflet">@lang('translation.Leaflet')</a></li>
                    </ul>
                </li>

                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="icon nav-icon" data-feather="share-2"></i>
                        <span class="menu-item">@lang('translation.Multi_Level')</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="true">
                        <li><a href="javascript: void(0);">@lang('translation.Level_1.1')</a></li>
                        <li><a href="javascript: void(0);" class="has-arrow">@lang('translation.Level_1.2')</a>
                            <ul class="sub-menu" aria-expanded="true">
                                <li><a href="javascript: void(0);">@lang('translation.Level_2.1')</a></li>
                                <li><a href="javascript: void(0);">@lang('translation.Level_2.2')</a></li>
                            </ul>
                        </li>
                    </ul>
                </li> --}}

            </ul>
        </div>
        <!-- Sidebar -->
    </div>
</div>
<!-- Left Sidebar End -->
