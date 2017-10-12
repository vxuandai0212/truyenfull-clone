<!DOCTYPE html>
<html lang="vi">

<head prefix="og: http://ogp.me/ns# fb: http://ogp.me/ns/fb# book: http://ogp.me/ns/book# profile: http://ogp.me/ns/profile#">
    <meta charset="UTF-8">
    @yield('title')
    <meta name="viewport" content="width=device-width,minimum-scale=1,initial-scale=1"> 
    @include('guestLayouts.css')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.css" />

    
</head>

<body id="body_home">
    <div id="wrap">
        <div class="navbar navbar-default navbar-static-top" role="navigation" id="nav">
            <div class="container">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse"><span class="sr-only">Hiện menu</span><span class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span></button>
                    <h1><a class="header-logo" href="http://truyenfull.vn/" title="doc truyen">doc truyen</a></h1></div>
                <div class="navbar-collapse collapse" itemscope itemtype="http://schema.org/WebSite">
                    <meta itemprop="url" content="http://truyenfull.vn" />
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
            $("#updated-list").nextAll().empty();
            $.each(data, function(index, subcatObj){
                $('#updated-list').append('<div class="row" itemscope="" itemtype="http://schema.org/Book"><div class="col-xs-9 col-sm-6 col-md-5 col-title"><span class="glyphicon glyphicon-chevron-right"></span> <h3 itemprop="name"><a href="'+subcatObj.slug+'" title="'+subcatObj.book_name+'" itemprop="url">'+subcatObj.book_name+'</a></h3><span class="label-title label-new"></span></div><div class="hidden-xs col-sm-3 col-md-3 col-cat text-888">'<a itemprop="genre" href="http://truyenfull.vn/the-loai/ngon-tinh/" title="Ngôn Tình">Ngôn Tình</a>, <a itemprop="genre" href="http://truyenfull.vn/the-loai/khoa-huyen/" title="Khoa Huyễn">Khoa Huyễn</a></div><div class="col-xs-3 col-sm-3 col-md-2 col-chap text-info"><a href="http://truyenfull.vn/mau-xuyen-nu-phu-phan-cong-nam-than-moi-mac-cau/chuong-19/" title="Mau Xuyên Nữ Phụ Phản Công: Nam Thần Mời Mắc Câu - Chương 19"><span class="chapter-text"><span>Chương </span></span>19</a></div><div class="hidden-xs hidden-sm col-md-2 col-time text-888">12 phút trước </div></div>');
            });
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

</script> 
</body>

</html>
