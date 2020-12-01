<?php if(isset($_SESSION['pedido']) && $_SESSION['pedido'] == 'complete'): ?>
<h1>Tu peido se ha confirmado</h1>
<p>Tu pedido ha sido guardado con exito, una vez finalizada la tranferencia bancaria, el pedido 
será procesado y enviado </p>

<?php elseif(isset($_SESSION['pedido']) && $_SESSION['pedido'] != 'comfir'):  ?>
<h1>El pedido no ha sido procesado</h1>
<?php endif; ?>