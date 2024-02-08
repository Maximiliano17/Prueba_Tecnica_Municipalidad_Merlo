<!DOCTYPE html>
<html lang="en">
<head> 
    <!--Meta-->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" href="../../assets/logos/municipalidadMerloLogo.png">
    <!--Fonts-->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap">
    <!--Css-->
    <link rel="stylesheet" href="../../styles/Invitado.css">
    <!--Title-->
    <title>Invitado</title>
</head>
<body>
     <!--Home--> 
     <div id="containerInvitado">   
       <form action="../../php/InvitadoValidation.php" method="POST" id="formInvitado">
            <h1>Invitado</h1>
             <input required class="inputInvitado" type="codigo" name="dni" placeholder="Ingresa el codigo">
         <section class="btnSection">
            <button class="btnInvitado">
                Ingresar
             </button> 
         </section>
       </form>
       <articulo id="containerInformation">
       </articulo>
     </div>   
</body>
</html>