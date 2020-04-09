//bejelentkezési/regisztrálási képernyő effekt
function bejReg() {
  $(document).ready(function() {
    $(".login a").click(function() {
      $(".register").slideDown("slow"),
        $(".login").slideUp("slow");
    });

    $(".register a").click(function() {
      $(".login").slideDown("slow"),
        $(".register").slideUp("slow");
    });
  })
};
