// Máscara para telefone/celular
$("#telefone, #celular").mask("(00) 00000-0000");

// Remover Classe Hidden da lista e botão visualizar
$("#btn_hidden").click(function () {
    $("#lista_contato.lista").toggleClass("hidden");
    $(".btn_view").toggleClass("hidden");
    $(".btn_hidden").toggleClass("hidden");
});

// Remover Classe Hidden da lista e botão ocultar
$("#btn_hidden2").click(function () {
    $("#lista_contato.lista").toggleClass("hidden");
    $(".btn_hidden").toggleClass("hidden");
    $(".btn_view").toggleClass("hidden");
});
