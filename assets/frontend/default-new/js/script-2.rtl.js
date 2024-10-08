$(document).ready(function(){
    var owl = $(".owl-carousel")
    owl.owlCarousel({
        nav: true,
        lazyLoad:false,
        items: 1,
        loop: true,
        autoplay:true,
        autoplayHoverPause: true,
        autoplayTimeout:3000,
        onInitialized: function() {
            $(".owl-dots").before(`
                <div class="custom-owl"></div>
            `)
            $(".owl-dots").appendTo(".custom-owl")

            $('.owl-next').html('<i class="fas fa-chevron-right"></i>').appendTo('.custom-owl')
            $('.owl-prev').html('<i class="fas fa-chevron-left"></i>').prependTo('.custom-owl')
        }
    });

})
  function updateTabIcon() {
    var stage3Tab = document.getElementById('stage3-tab');
    var stage2Tab = document.getElementById('stage2-tab');
    var stage1Tab = document.getElementById('stage1-tab');

    $(".nav-link.previous").removeClass("previous")

    if (stage3Tab.classList.contains('active')) {
        stage2Tab.classList.add('previous');
        stage1Tab.classList.add('previous');
    } else if (stage2Tab.classList.contains('active')) {
        stage1Tab.classList.add('previous');
    }
}

// Event listener to update tab icon on tab change
$(document).on('shown.bs.tab', function(event) {
    updateTabIcon();
});
function tab_navigator(tabId) {
  var tab = document.querySelector(tabId);
  if (tab) {
      var tabInstance = new bootstrap.Tab(tab);
      tabInstance.show();
  }
}

$("#change-theme").click(function(){
    const xhr = new XMLHttpRequest();
    xhr.open('POST', '/home/set_mode', true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    if($(this).hasClass("fa-moon"))
    {
        $("body").addClass("dark-theme")
        $(this).removeClass("fa-moon")
        $(this).addClass("fa-sun")
        xhr.send('theme_mode=dark-theme');
    }
    else
    {
        $("body").removeClass("dark-theme")
        $(this).addClass("fa-moon")
        $(this).removeClass("fa-sun")
        xhr.send('theme_mode=');
    }
})

var default_country = window.CountryList.findOneByDialCode('+971')
$("#default-country-icon").html(window.CountryFlagSvg[default_country.code])

var countries = window.CountryList.getAll()
for(country of countries)
{
    $("#countries_list").append(`
        <li class="option" data-code="${country.code}">
            <div>
                <div class="flag">${window.CountryFlagSvg[country.code]}</div>
                <span class="country-name">${country.name}</span>
            </div>
            <strong id="default-tel-code" class="me-2">${country.dial_code}</strong>
        </li>
    `)
}

const select_box = $(".select-box .options")
const selected_option = $(".selected-option .country_data")

selected_option.click(function(){
    select_box.fadeToggle()
})
$(".select-box .selected-option input").focus(function(){
    select_box.hide()
})

$("#countries_list li").click(function(){
    var code = $(this).attr("data-code")
    var country = window.CountryList.findOneByCountryCode(code)
    $("#default-country-icon").html(window.CountryFlagSvg[code])
    $("#default-tel-code").html(country.dial_code)
    $("#tel_code").val(country.dial_code)
    select_box.hide()
})
// Get the button
let mybutton = document.getElementById("scrollToTopBtn");

// Show the button when the user scrolls down 20px from the top of the document
window.onscroll = function() {
    scrollFunction();
};

function scrollFunction() {
    if (document.body.scrollTop > 150 || document.documentElement.scrollTop > 150) {
        mybutton.style.display = "block";
    } else {
        mybutton.style.display = "none";
    }
}

// Scroll to the top when the user clicks the button
mybutton.onclick = function() {
    document.body.scrollTop = 0;
    document.documentElement.scrollTop = 0;
};

$("select[name='school_opener']").change(function(){
    var class_id = $(this).val()
    if(class_id != "")
    {
        window.location = 'school?class=' + class_id
    }
})

var navbar = $('.main-nav');
var navbarOffset = navbar.offset().top;

$(window).on('scroll', function () {
    if ($(window).scrollTop() > navbarOffset) {
        navbar.addClass('floating-nav');
    } else {
        navbar.removeClass('floating-nav');
    }
});


$(".sing-up-right form div input").change(function(){
    if($(this).val().length > 0){
        $(this).attr("filled", 1)
    }
    else
    {
        $(this).attr("filled", 0)
    }
})