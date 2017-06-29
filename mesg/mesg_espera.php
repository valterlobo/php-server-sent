<!DOCTYPE html>
<?php
// NOTA: Este código não é totalmente funcional, mas apenas um exemplo!

$sessionID = session_id();
if(empty($sessionID)) session_start();

$sessionID =  session_id();


?> 
<html>

<head>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" /><script
              src="https://code.jquery.com/jquery-3.2.1.min.js"
              integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4="
              crossorigin="anonymous"></script>





<title>Espera Resultado - Teste Stream</title>


</head>

<body>

<h2>Veja o console </h2>

<p title="Veja o Console">



<button>Send  Mesg </button>

</p>

</body>


<script type="text/javascript">


$(document).ready(function()
{



   //

   $("button").click(function(){
        $.post("mesg_send.php",
        {
          name: "Valter Lobo",
          valor: "12222220000000"
        },
        function(data,status){
            alert("Data: " + data + "\nStatus: " + status);
        });
    });

  //Event Source 
   var uuid_session = "<?=$sessionID ?>" ; 

  if (!!window.EventSource) {
    var source = new EventSource('mesg_stream.php');
  } else {
    alert('Não tem EventSource');
  }


  source.addEventListener('listernerMessage' + uuid_session , function(e) {
    console.log(e);
    var data = JSON.parse(e.data);
    console.log(data);
    console.log(data.data.cpf);
     console.log(data.session);

    if(uuid_session==data.session)
    {
       alert("Session igual " +  uuid_session   + " | " + data.session ); 

    }else
    {

      alert("Session diferente " +  uuid_session   + " | " + data.session  );

    }

  }, false);

  source.addEventListener('open', function(e) {
    logger.log('> Connection was opened');
  }, false);

  source.addEventListener('error', function(e) {
    if (e.readyState == EventSource.CLOSED) {
       logger.log('> Connection was closed');
    }
  }, false);

});
</script>
</html>

