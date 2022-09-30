<?php

include 'includes/cabecalho.php';
include 'includes/classes/class.conexao.php';
include 'includes/classes/class.professor.php';

?>

<form action="professores.php">
  <label for="pname">Digite o nome do professor:</label><br>
  <input type="text" id="pname" name="pname" class="search">
  <input type="submit" value="Enviar">
</form>

<?php

$pesquisa = "";

if(isset($_GET['pname'])){
    $pesquisa = $_GET['pname'];
}

$professores = Professor::pesquisarProfessores("nome", $pesquisa);

if (count($professores) > 0) {
    echo "<table class='table table-sm table-hover table-bordered results'>";
    echo "<thead>";
    echo "<tr>";
    echo "<th scope='col'>ID Professor</th>";
    echo "<th scope='col'>Nome</th>";
    echo "<th scope='col'>Especialidades</th>";
    echo "<th scope='col'>Currículo</th>";
    echo "</tr>";
    echo "</thead>";
    echo "<tbody>";
    // output data of each row
    $i = 0;
    while($i < count($professores)) {
        echo "<tr>";
        echo "<th scope='row'>" . $professores[$i]->id . "</th>";
        echo "<td>" . ucwords($professores[$i]->nome) . "</td>";
        echo "<td>" . $professores[$i]->especialidade . "</td>";
        echo "<td><a href='https://lattes.com.br/" . $professores[$i]->lattes . "/'>Link</a></td>";
        echo "</tr>";
        $i++;
    }   
    echo "</tbody>";
    echo "</table>";
} else {
  echo "Nenhum professor encontrado com o termo $pesquisa.";
}

?>

<script>
  $(document).ready(function() {
  $(".search").keyup(function () {
    console.log("Cheguei aqui");
    var searchTerm = $(".search").val();
    var listItem = $('.results tbody').children('tr');
    var searchSplit = searchTerm.replace(/ /g, "'):containsi('")
    console.log(searchSplit);
    
  $.extend($.expr[':'], {'containsi': function(elem, i, match, array){
        return (elem.textContent || elem.innerText || '').toLowerCase().indexOf((match[3] || "").toLowerCase()) >= 0;
    }
  });
    
  $(".results tbody tr").not(":containsi('" + searchSplit + "')").each(function(e){
    $(this).attr('visible','false');
  });

  $(".results tbody tr:containsi('" + searchSplit + "')").each(function(e){
    $(this).attr('visible','true');
  });

  //var jobCount = $('.results tbody tr[visible="true"]').length;
  //  $('.counter').text(jobCount + ' item');
  //console.log(jobCount);

  //if(jobCount == '0') {$('.no-result').show();}
  //  else {$('.no-result').hide();}
	  });
});
</script>

<?php

include 'includes/rodape.php';

?>