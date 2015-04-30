<?php use mvc\routing\routingClass as routing?>
<?php use mvc\config\configClass as config?>
<?php use mvc\request\requestClass as request?>
<form id="frmTraductor" action="<?php echo routing::getInstance()->getUrlWeb('animal', 'traductor') ?>" method="POST" >
    <select name="language" onchange="$('#frmTraductor').submit()">
        <option <?php echo (config::getDefaultCulture() == 'es') ? 'selected' : '' ?> value="es">Español</option>
        <option <?php echo (config::getDefaultCulture() == 'en') ? 'selected' : '' ?> value="en">English</option>
    </select> 
    <input type="hidden" name="PATH_INFO" value="<?php echo request::getInstance()->getServer('PATH_INFO')?>">
</form>
