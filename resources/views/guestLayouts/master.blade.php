<!DOCTYPE html>
<html lang="vi">

<head prefix="og: http://ogp.me/ns# fb: http://ogp.me/ns/fb# book: http://ogp.me/ns/book# profile: http://ogp.me/ns/profile#">
    <meta charset="UTF-8">
    @yield('title')
    <meta name="viewport" content="width=device-width,minimum-scale=1,initial-scale=1"> 
    @include('guestLayouts.css')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.1/jquery.min.js"></script>


    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.css" />
    <style>
        .ui-menu {z-index: 9999}
        .ui-menu .ui-menu-item {
            color: #515151;}
        .ui-menu .ui-menu-item h4 b {
            color: #000!important;
        }
    </style>
    
</head>

<body id="body_home">
    <div id="wrap">
        <div class="navbar navbar-default navbar-static-top" role="navigation" id="nav">
            <div class="container">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse"><span class="sr-only">Hiện menu</span><span class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span></button>
                    <h1><a class="header-logo" href="{{route('home')}}" title="doc truyen">doc truyen</a></h1></div>
                <div class="navbar-collapse collapse" itemscope itemtype="http://schema.org/WebSite">
                    <meta itemprop="url" content="" />
                    @include('guestLayouts.navBar')
                    @include('guestLayouts.searchBar')
                    <div id="login-status" class="hide"></div>
                </div>
            </div>
            @yield('breadcrumb')
        </div>
      @yield('content')
    </div>
    @include('guestLayouts.footer')
    @include('guestLayouts.script')
    @yield('script')
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<link href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.css" rel="stylesheet" type="text/css" media="all"/>
<script type="text/javascript">
$(document).ready(function(){
    $("#search-input").autocomplete({
        source: "{{ url('/search/ajax') }}",
            focus: function( event, ui ) {
            //$( "#search" ).val( ui.item.title ); // uncomment this line if you want to select value to search box  
            return false;
        },
        select: function( event, ui ) {
            window.location.href = ui.item.url;
        }
    }).data( "ui-autocomplete" )._renderItem = function( ul, item ) {
        var inner_html = '<a href="' + item.url + '" ><div class="list_item_container"><div class="label"><h4><b>' + item.title + '</b></h4></div></div></a>';
        return $( "<li></li>" )
                .data( "item.autocomplete", item )
                .append(inner_html)
                .appendTo( ul );
    };
});
</script> 
<script>
    $('#hot-select').on('change', function(e){
        console.log(e);
        var cat_id = e.target.value;
        $.get('ajax-subcathot?cat_id=' +cat_id, function(data){
            $('.index-intro').empty();
            $.each(data, function(index, subcatObj){
                $('.index-intro').append('<div class="item top-'+(index+1)+'" itemscope="" itemtype="http://schema.org/Book"><a href="'+subcatObj.slug+'" itemprop="url"><span class="full-label"></span><img src="/images/'+subcatObj.image+'" alt="'+subcatObj.book_name+'" class="img-responsive item-img" itemprop="image"><div class="title"><h3 itemprop="name">'+subcatObj.book_name+'</h3></div></a></div>');
            });
        });
    });

    $('#new-select').on('change', function(e){
        console.log(e);
        var cat_id = e.target.value;
        $.get('ajax-subcatnew?cat_id=' +cat_id, function(data){
            $('#updated-list').html(data);
        });
    });

    /* When the user clicks on the button,
toggle between hiding and showing the dropdown content */
    // Dropdown Menu
    var dropdown = document.querySelectorAll('.dropdown');
    var dropdownArray = Array.prototype.slice.call(dropdown,0);
    dropdownArray.forEach(function(el){
        var button = el.querySelector('a[data-toggle="dropdown"]'),
            menu = el.querySelector('.dropdown-menu');

        button.onclick = function(event) {
            if(!menu.hasClass('show')) {
                menu.classList.add('show');
                menu.classList.remove('hide');
                event.preventDefault();
            }
            else {
                menu.classList.remove('show');
                menu.classList.add('hide');
                event.preventDefault();
            }
        };
    })

    Element.prototype.hasClass = function(className) {
        return this.className && new RegExp("(^|\\s)" + className + "(\\s|$)").test(this.className);
    };


    $(function() {

    $('#hotday').click(function(e) {
        $("#hotbook-list").fadeOut(100);
		$("#hotbook-list").delay(100).fadeIn(100);
		$('#hotmonth').removeClass('active');
        $('#hotalltime').removeClass('active');
		$(this).addClass('active');
		e.preventDefault();
        $.get('ajax-hotlist?date=day', function(data){
            $('#hotbook-list').html(data);
        });
	});
    $('#hotmonth').click(function(e) {
        $("#hotbook-list").fadeOut(100);
		$("#hotbook-list").delay(100).fadeIn(100);
		$('#hotday').removeClass('active');
        $('#hotalltime').removeClass('active');
		$(this).addClass('active');
		e.preventDefault();
        $.get('ajax-hotlist?date=month', function(data){
            $('#hotbook-list').html(data);
        });
	});
    $('#hotalltime').click(function(e) {
        $("#hotbook-list").fadeOut(100);
		$("#hotbook-list").delay(100).fadeIn(100);
		$('#hotmonth').removeClass('active');
        $('#hotday').removeClass('active');
		$(this).addClass('active');
		e.preventDefault();
        $.get('ajax-hotlist?date=all', function(data){
            $('#hotbook-list').html(data);
        });
	});

});

</script> 
</body>

</html>
