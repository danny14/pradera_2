<?php use mvc\routing\routingClass as routing?>
<div class=" container container-fluid">
    <div class=" row">
        <form action="../controller/config/createActionClass" method="POST" enctype="multipart/form-data">
            <input type="text" value="DbHost">
            <input type="text" value="DbDriver">
            <input type="text" value="DbName">
            <input type="text" value="DbPort">
            <input type="text" value="DbUser">
            <input type="text" value="DbPassword">
            <input type="text" value="PathAbsolute">
            <input type="text" value="Hola">
            <input type="submit">
        </form>
    </div>
</div>