// interação com menu mobile
$(document).ready(function () {
  $("#menu-mobile").click(function () {
    const icon = $("#icon-menu-mobile");
    if (icon.hasClass("fa-list")) {
      icon.removeClass("fa-list").addClass("fa-xmark");
    } else {
      icon.removeClass("fa-xmark").addClass("fa-list");
    }
  });
});

// filtro
$(document).ready(function () {
  // Abrir a aba de pesquisa
  $("#filter-link").click(function () {
    const iconfilter = $("#icon-filter");
    if (iconfilter.hasClass("fa-filter")) {
      iconfilter.removeClass("fa-filter").addClass("fa-filter-circle-xmark");
    } else {
      iconfilter.removeClass("fa-filter-circle-xmark").addClass("fa-filter");
    }
    $("#search-box").slideToggle();
  });

  // Fechar a aba de pesquisa
});
// filtro produtos

// modal
$("#delete-modal").on("show.bs.modal", function (event) {
  var button = $(event.relatedTarget);
  var id = button.data("customer");

  var modal = $(this);
  modal.find(".modal-title").text("Excluir Cliente: " + id);
  modal
    .find(".modal-body")
    .text("Deseja realmente excluir o cliente " + id + "?");
  modal.find("#confirm").attr("href", "delete.php?id=" + id);
});
// modal produtos
$("#delete-modal-game").on("show.bs.modal", function (event) {
  var button = $(event.relatedTarget);
  var id = button.data("produto");

  var modal = $(this);
  modal.find(".modal-title").text("Excluir Produto: " + id);
  modal
    .find(".modal-body")
    .text("Deseja realmente excluir o Produto " + id + "?");
  modal.find("#confirm").attr("href", "delete.php?id=" + id);
});
// modal usuarios
$("#delete-modal-usuario").on("show.bs.modal", function (event) {
  var button = $(event.relatedTarget);
  var id = button.data("usuario");

  var modal = $(this);
  modal.find(".modal-title").text("Excluir usuario: " + id);
  modal
    .find(".modal-body")
    .text("Deseja realmente excluir o usuario " + id + "?");
  modal.find("#confirm").attr("href", "delete.php?id=" + id);
});

// modal login
// abrir
$(document).ready(function () {
  $("#login-open").click(function () {
    const loginModal = $(".modal-login-open");
    if (loginModal.hasClass("hidden")) {
      loginModal.removeClass("hidden");
      loginModal.animate({ opacity: 1 }, 400);
    }
  });
});

// fechar modal
$(document).ready(function () {
  function fecharModal() {
    if (!$(".modal-login-open").hasClass("hidden")) {
      $(".modal-login-open").addClass("hidden");
      $(".modal-login-open").animate({ opacity: 0 }, 400);
    }
  }
  $("#mclose").click(function () {
    fecharModal();
  });

  $(".modal-login-open").on("click", function (event) {
    if (event.target === this) {
      fecharModal();
    }
  });

  $(document).on("keydown", function (event) {
    if (event.key === "Escape") {
      fecharModal();
    }
  });
});

// modal cookies
$(document).ready(function () {
  const cookiesAccepted = localStorage.getItem("cookiesAccepted");

  // Mostrar aviso de cookies se ainda não aceitou
  if (!cookiesAccepted) {
    $("#cookieModal").fadeIn();
  }

  // Quando o usuário clica em "Ok, Obrigado"
  $("#acceptCookies").on("click", function () {
    localStorage.setItem("cookiesAccepted", "true"); // Marca que foi aceito
    $("#cookieModal").fadeOut();
  });

  // Botão "Detalhes" já funciona com data-bs-toggle e data-bs-target
  // Não precisa alterar
});
