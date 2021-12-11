$("#home-banner-superior-tns-carousel").children().each(function () {
    $("#home-banner-superior-nav-container").append("<div class='item'></div>")
});

try {
    $(window).on("load", function () {

        var tnsHomeBannerSuperior = tns({
            container: "#home-banner-superior-tns-carousel",
            navContainer: "#home-banner-superior-nav-container",
            items: 1,
            mode: "gallery",
            autoplay: true,
            autoHeight: true,
            controls: false,
            autoplayButtonOutput: false,
            autoplayHoverPause: true,
            // onInit: function (info) {

            //     var domAtual = info.slideItems[info.index];
            //     var tipoAtual = $(domAtual).attr("data-exp-tipo");
            //     console.log(tipoAtual)
            //     if (tipoAtual == 'vid') {
            //         domAtual.play();
            //         console.log("entrou if video no init");
            //         console.log(this);

            //         $(domAtual).on("playing", function (e) {
            //             var video = e.target;
            //             console.log("vid on home slider playing");
            //             console.log("slider paused");
            //             //tnsHomeBannerSuperior.pause();
            //         });

            //         $(domAtual).on("pause", function (e) {
            //             console.log("vid on home slider paused");
            //             console.log("slider played");
            //             //tnsHomeBannerSuperior.play();
            //         });
            //     }
            // }
        });

        // var customizedFunction = function (info, eventName) {
        //     // direct access to info object
        //     console.log(info.slideItems[info.index]);
        // }

        // // bind function to event
        // tnsHomeBannerSuperior.events.on('indexChanged', customizedFunction);



        // $("#home-banner-superior-tns-carousel").find("video").on("playing", function (e) {
        //     var video = e.target;
        //     // video.load();
        //     console.log("vid on home slider playing");
        //     console.log("slider paused");
        //     tnsHomeBannerSuperior.pause();
        // });

        // $("#home-banner-superior-tns-carousel").find("video").on("pause", function (e) {
        //     console.log("vid on home slider paused");
        //     console.log("slider played");
        //     tnsHomeBannerSuperior.play();
        // });




        // var customizedFunction = function (info, eventName) {
        //     // direct access to info object
        //     console.log(info.event.type, info.container.id);
        //   }


    });
} catch (error) { }

try {
    var tnsHomeFaixaExperiencia = tns({
        container: "#home-faixa-experiencia-tns-carousel",
        navContainer: "#home-faixa-experiencia-nav-container",
        items: 1,
        controls: false,
        autoHeight: false,
        autoplay: false,
        autoplayTimeout: 2000,
        autoplayHoverPause: true,
        autoplayButtonOutput: false,
    });
} catch (error) { }


// função para filtro: são previstas 4 hipóteses:
// Caso esteja filtrado por nao tag e nao texto (mostra tudo)
// Caso esteja filtrado por tag e nao por texto (filtra tag)
// Caso esteja filtrado por tag e por texto (filtra tag e texto)
// Caso esteja filtrado por texto e nao tag (filtra texto)
// Caso esteja filtrado por texto e tag (filtra tag e texto)

$("#cases-faixa-filtro").find(".ul-tags-container").find("a").click(function (event) {
    event.preventDefault();
    //limpa o efeito ativo e altera para o filtro atual
    $(this).parent().parent().find(".ativo").removeClass("ativo");
    $(this).addClass("ativo");
    $("#cases-faixa-cases").attr("data-explay-filter-tag", $(this).attr("href"));
    var tag = $("#cases-faixa-cases").attr("data-explay-filter-tag");
    var paramPesquisa = $("#cases-faixa-cases").attr("data-explay-filter-pesquisa");
    if ((tag == "*")) { //Caso queira mostrar todos
        $("#cases-faixa-cases").find(".case-container").fadeIn();
        $("#cases-faixa-cases").attr("data-explay-filter-pesquisa", "");
        $("#cases-faixa-filtro-input-search").val("");
        $("#cases-faixa-filtro-input-search").hide();
    } else if ((tag == "*") && (paramPesquisa != "*")) { //Caso esteja filtrado por nao tag e por texto
        $("#cases-faixa-cases").find(".case-container").each(function () {
            var tituloCase = $(this).find(".card-case-titulo").text().toLowerCase();
            if (tituloCase.indexOf(paramPesquisa) >= 0) {
                $(this).fadeIn();
            } else {
                $(this).fadeOut();
            }
        });
    } else if ((tag != "*") && (paramPesquisa == "")) { // Caso esteja filtrado por tag e nao texto
        $("#cases-faixa-cases").find(".case-container").each(function () {
            if ($(this).hasClass(tag)) {
                $(this).fadeIn();
            } else {
                $(this).fadeOut();
            }
        });
    } else if ((tag != "*") && (paramPesquisa != "*")) { // Caso esteja filtrado por tag e por texto
        $("#cases-faixa-cases").find(".case-container").each(function () {
            if ($(this).hasClass(tag)) {
                var tituloCase = $(this).find(".card-case-titulo").text().toLowerCase();
                if (tituloCase.indexOf(paramPesquisa) >= 0) {
                    $(this).fadeIn();
                } else {
                    $(this).fadeOut();
                }
            } else {
                $(this).fadeOut();
            }
        });
    }
});

$("#cases-faixa-filtro-btn-lupa").click(function (event) {
    event.preventDefault();

    if ($("#cases-faixa-filtro-input-search").is(":hidden")) {
        $("#cases-faixa-filtro-input-search").show();
        $("#cases-faixa-filtro-input-search").focus();
        return false;
    } else {
        $("#cases-faixa-cases").attr("data-explay-filter-pesquisa", $("#cases-faixa-filtro-input-search").val().toLowerCase());
        var tag = $("#cases-faixa-cases").attr("data-explay-filter-tag");
        var paramPesquisa = $("#cases-faixa-cases").attr("data-explay-filter-pesquisa");
        if ((tag == "*") && (paramPesquisa == "")) { //Caso esteja filtrado por nao tag e nao texto
            $("#cases-faixa-cases").find(".case-container").fadeIn();
        } else if ((tag == "*") && (paramPesquisa != "*")) { //Caso esteja filtrado por nao tag e por texto
            $("#cases-faixa-cases").find(".case-container").each(function () {
                var tituloCase = $(this).find(".card-case-titulo").text().toLowerCase();
				var tagsCase = $(this).find(".card-case-tags-text").text().toLowerCase();
				console.log(tagsCase);
                if (tituloCase.indexOf(paramPesquisa) >= 0) {
                    $(this).fadeIn();
                }else if (tagsCase.indexOf(paramPesquisa) >= 0) {
                    $(this).fadeIn();
                } else {
                    $(this).fadeOut();
                }
            });
        } else if ((tag != "*") && (paramPesquisa == "")) { // Caso esteja filtrado por tag e nao texto
            $("#cases-faixa-cases").find(".case-container").each(function () {
                if ($(this).hasClass(tag)) {
                    $(this).fadeIn();
                } else {
                    $(this).fadeOut();
                }
            });
        } else if ((tag != "*") && (paramPesquisa != "*")) { // Caso esteja filtrado por tag e por texto
            $("#cases-faixa-cases").find(".case-container").each(function () {
                if ($(this).hasClass(tag)) {
                    var tituloCase = $(this).find(".card-case-titulo").text().toLowerCase();
					var tagsCase = $(this).find(".card-case-tags-text").text().toLowerCase();
					console.log(tagsCase);
                    if (tituloCase.indexOf(paramPesquisa) >= 0) {
                        $(this).fadeIn();
                    }else if (tagsCase.indexOf(paramPesquisa) >= 0) {
                    	$(this).fadeIn();
                	} else {
                        $(this).fadeOut();
                    }
                } else {
                    $(this).fadeOut();
                }
            });
        }
    }
});

$("#blog-faixa-filtro-btn-lupa").click(function (event) {
    if ($("#blog-faixa-filtro-input-search").is(":hidden")) {
        event.preventDefault();
        $("#blog-faixa-filtro-input-search").show();
        $("#blog-faixa-filtro-input-search").focus();
    }
});

$(".ul-tags-container").find("a.ativo").click();

$('#veja-mais').click(function() {
    $('#home-faixa-lista').slideToggle(500, callbackFn);
});

function callbackFn(){
    var $lista = $('#veja-mais p');

    $(this).is(":visible") ? $lista.text("Fechar lista de empresas «") : $lista.text("Veja a lista completa de empresas que já atendemos »");
}