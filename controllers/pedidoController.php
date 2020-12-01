<?php

require_once 'models/Pedido.php';

class pedidoController
{
    public function hacer()
    {
        require_once 'views/pedido/hacer.php';
    }

    public function add()
    {
        if (isset($_SESSION['identity'])) {
            $usuario_id = isset($_SESSION['identity']->id);
            $provincia = isset($_POST['provincia']) ? $_POST['provincia'] : false;
            $direccion = isset($_POST['direccion']) ? $_POST['direccion'] : false;
            $localidad = isset($_POST['localidad']) ? $_POST['localidad'] : false;

            $stats = Utils::statsCarrito();
            $coste = $stats['total'];
            if ($provincia && $direccion && $localidad) {
                $pedido = new Pedido();
                $pedido->setUsuario_id($usuario_id);
                $pedido->setProvincia($provincia);
                $pedido->setDireccion($direccion);
                $pedido->setLocalidad($localidad);
                $pedido->setCoste($coste);
                
                $save = $pedido->save();

                //Guardar línea pedido
                $save_linea = $pedido->save_linea();

                if ($save && $save_linea) {
                    $_SESSION['pedido'] = 'complete';
                } else {
                    $_SESSION['pedido'] = 'failed';
                }
            } else {
                $_SESSION['pedido'] = 'failed';
            }

            header('Location:' . base_url.'pedido/confirmado');


        } else {
            header('Location:' . base_url);
        }
    }

    public function confirmado(){
        require_once 'views/pedido/confirmado.php';
    }
}
