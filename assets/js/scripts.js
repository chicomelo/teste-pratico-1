$(document).ready(function () {

    if ($('body').hasClass('product-page')) {
        $('.slider-foto').slick({
            slidesToShow: 1,
            slidesToScroll: 1,
            arrows: false,
            fade: false,
            asNavFor: '.slider-thumbs'
        });
        $('.slider-thumbs').slick({
            slidesToShow: 5,
            slidesToScroll: 1,
            asNavFor: '.slider-foto',
            dots: false,
            focusOnSelect: true
        });

        // hover avaliação
        $('body').on('mouseover', '.form-avaliacao button', function(){
            let valor = parseInt($(this).data("valor"));

            $(".form-avaliacao button").each(function(){
                let atual = parseInt($(this).data("valor"));
                if (atual <= valor) {
                    $(this).addClass("active");
                } else {
                    $(this).removeClass("active");
                }
            })
        })

        $('body').on('mouseleave', '.form-avaliacao', function(){
        $(".form-avaliacao button").removeClass("active");
        });

        // evita refresh do form
        $('body').on('submit', '.form-avaliacao', function(e){
            e.preventDefault();
        });

        // Ação avaliação
        // Recupera os ratings do localStorage




        const slug = getSlugFromURL();
        var ratings = [];

        $.getJSON("products.json", function (produtos) {

            const produto = produtos.find(p => p.slug === slug);

            if (!produto) {
                console.warn("Produto não encontrado para o slug:", slug);
                return;
            }

            const produtoId = produto.id;
            // Recupera os ratings salvos
            ratings = JSON.parse(localStorage.getItem("@ratings") || "[]");

            // Filtra só os ratings do produto atual
            ratings = ratings.filter(r => r.id === produtoId);

            atualizaRating(ratings, produtoId)

        });

        // Ao clicar em uma estrela
        $('body').on('click', '.form-avaliacao button', function (e) {
            e.preventDefault();

            const valor = parseInt($(this).data("valor"));
            const produtoId = parseInt($(this).data("id"));

            ratings.push({ id: produtoId, rating: valor });
            localStorage.setItem("@ratings", JSON.stringify(ratings));
            atualizaRating(ratings, produtoId);
        });

        function atualizaRating(ratings, produtoId) {

            const ratingsProduto = ratings.filter(r => r.id === produtoId);
            
            if (ratingsProduto.length === 0) return;
    
            const soma = ratingsProduto.reduce((total, r) => total + r.rating, 0);
            const media = soma / ratingsProduto.length;

            $('.text-warning .media').html(media.toFixed(2));
            $('.text-dark b').html(ratingsProduto.length > 1 ? ratingsProduto.length + ' avaliações' : ratingsProduto.length + ' avaliação' )
        }

        function getSlugFromURL() {
            const params = new URLSearchParams(window.location.search);
            return params.get("slug");
        }


    }


    // filtro buscar
    function filtrarProdutos(termo) {
        $(".card").each(function () {
            let titulo = $(this).find(".card-title").text().toLowerCase();
            if (titulo.includes(termo)) {
                $(this).closest(".col-3").show();
            } else {
                $(this).closest(".col-3").hide();
            }
        });
    }

    // busca ao digitar pelo menos 3 caracteres
    $("input[type='search']").on("input", function () {
        let termo = $(this).val().toLowerCase().trim();

        if (termo.length >= 3) {
            filtrarProdutos(termo);
        } else {
            $(".card").closest(".col-3").show();
        }
    });

    // ao pressionar o submit
    $(".form-buscar").on("submit", function (e) {
        e.preventDefault();
        let termo = $("input[type='search']").val().toLowerCase().trim();

        if (termo.length >= 3) {
            filtrarProdutos(termo);
        } else {
            $(".card").closest(".col-3").show();
        }
    });

});