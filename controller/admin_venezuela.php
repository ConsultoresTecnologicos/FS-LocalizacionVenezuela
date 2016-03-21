<?php

/*
 * This file is part of FacturaSctipts
 * Copyright (C) 2016  Leonardo Javier Alviarez Hernández leonardoalviarez@consultorestecnologicos.com.ve
 * Copyright (C) 2016  A.C. Consultores Tecnológicos R.L. admin@consultorestecnologicos.com.ve
 * http://www.consultorestecnologicos.com.ve
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU Affero General Public License as
 * published by the Free Software Foundation, either version 3 of the
 * License, or (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU Affero General Public License for more details.
 *
 * You should have received a copy of the GNU Affero General Public License
 * along with this program.  If not, see <http://www.gnu.org/licenses/>.
 */

/**
 * Description of admin_venezuela
 *
 * @author Leonardo Javier Alviarez Hernández (LJAH)
 */
class admin_venezuela extends fs_controller
{
  // LJAH: Estas variables deberían ir en un archivo que sea accesible por todo el plugin
  // más adelante deben cambiarse, incluso algunas deberían ser constantes.
   public $directorio_plugin = 'FS-LocalizacionVenezuela';
   public $nombre_plugin = 'Localizacion Venezuela';
   public $coddivisa = 'VEF';
   public $codpais = 'VEN';

   public function __construct()
   {
      parent::__construct(__CLASS__, $this->nombre_plugin, 'admin');
   }

   protected function private_core()
   {
      $this->share_extensions();

      if( isset($_GET['opcion']) )
      {
         if($_GET['opcion'] == 'moneda')
         {
            $this->empresa->coddivisa = $this->coddivisa;
            if( $this->empresa->save() )
            {
               $this->new_message('Datos guardados correctamente.');
            }
         }
         else if($_GET['opcion'] == 'pais')
         {
            $this->empresa->codpais = $this->codpais;
            if( $this->empresa->save() )
            {
               $this->new_message('Datos guardados correctamente.');
            }
         }
      }
   }

   private function share_extensions()
   {
      $fsext = new fs_extension();
      $fsext->name = 'puc_venezuela';
      $fsext->from = __CLASS__;
      $fsext->to = 'contabilidad_ejercicio';
      $fsext->type = 'fuente';
      $fsext->text = 'PUC Venezuela';
      $fsext->params = 'plugins/'.$this->directorio_plugin.'/extras/venezuela.xml';
      $fsext->save();
   }
}
