var proj = (function($){

    function afterLoad(){ 
        
      if ($('.slick-slides-capa').length > 0) {

        $('.slick-slides-capa').slick({
          infinite: true,
          slidesToShow: 1,
          slidesToScroll: 1,
          dots: false,
          arrows: true,
          prevArrow: '.nav-prev-capa',
          nextArrow: '.nav-next-capa',
          autoplay: true,
          autoplaySpeed: 6000,
          fade: false,
        });

      }

      $('.js-see-more').on('click', function (e) {
        e.preventDefault();
        $('.barco-information').toggleClass('ativo');
        $('.barco-seemore').toggleClass('ativo');
      });
      
        
    } 
        
    return {
        inicializa : afterLoad
    }

})( jQuery );

jQuery(document).ready( proj.inicializa );

var QueryString = function () {
  // This function is anonymous, is executed immediately and 
  // the return value is assigned to QueryString!
  var query_string = {};
  var query = window.location.search.substring(1);
  var vars = query.split("&");
  for (var i=0;i<vars.length;i++) {
    var pair = vars[i].split("=");
        // If first entry with this name
    if (typeof query_string[pair[0]] === "undefined") {
      query_string[pair[0]] = decodeURIComponent(pair[1]);
        // If second entry with this name
    } else if (typeof query_string[pair[0]] === "string") {
      var arr = [ query_string[pair[0]],decodeURIComponent(pair[1]) ];
      query_string[pair[0]] = arr;
        // If third or later entry with this name
    } else {
      query_string[pair[0]].push(decodeURIComponent(pair[1]));
    }
  } 
  return query_string;
}();

function string_to_slug (str) {
  str = str.replace(/^\s+|\s+$/g, ''); // trim
  str = str.toLowerCase();

  // remove accents, swap ñ for n, etc
  var from = "àáãäâèéëêìíïîòóöôùúüûñç·/_,:;";
  var to   = "aaaaaeeeeiiiioooouuuunc------";

  for (var i=0, l=from.length ; i<l ; i++) {
      str = str.replace(new RegExp(from.charAt(i), 'g'), to.charAt(i));
  }

  str = str.replace(/[^a-z0-9 -]/g, '') // remove invalid chars
      .replace(/\s+/g, '-') // collapse whitespace and replace by -
      .replace(/-+/g, '-'); // collapse dashes

  return str;
}