(function(){$(".side-menu").on("click",function(){$(this).parent().find("ul").length&&($(this).parent().find("ul").first()[0].offsetParent!==null?($(this).find(".side-menu__sub-icon").removeClass("transform rotate-180"),$(this).removeClass("side-menu--open"),$(this).parent().find("ul").first().slideUp(300,function(){$(this).removeClass("side-menu__sub-open")})):($(this).find(".side-menu__sub-icon").addClass("transform rotate-180"),$(this).addClass("side-menu--open"),$(this).parent().find("ul").first().slideDown(300,function(){$(this).addClass("side-menu__sub-open")})))});const i=function s(){return $(".side-menu").each(function(){if(this._tippy==null){const e=$(this).find(".side-menu__title").html().replace(/<[^>]*>?/gm,"").trim();tippy(this,{content:e,arrow:roundArrow,animation:"shift-away",placement:"right"})}$(window).width()<=1260||$(this).closest(".side-nav").hasClass("side-nav--simple")?this._tippy.enable():this._tippy.disable()}),s}();window.addEventListener("resize",()=>{i()})})();
