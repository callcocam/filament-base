<?php

/**
 * Created by Claudio Campos.
 * User: callcocam@gmail.com, contato@sigasmart.com.br
 * https://www.sigasmart.com.br
 */

return [
     "modelLabel" => "Tenant",
     "pluralModelLabel" => "Tenants",
     "navigationLabel" => "Tenants",
     "navigationGroup" => "Operacional",
     "forms" => [
          "name" => [
               "label" => "Nome",
               "placeholder" => "Nome",
          ],
          "slug" => [
               "label" => "Slug",
               "placeholder" => "Slug",
          ],
          "email" => [
               "label" => "Email",
               "placeholder" => "Email",
          ],
          "document" => [
               "label" => "Document",
               "placeholder" => "Document",
          ],
          "phone" => [
               "label" => "Phone",
               "placeholder" => "Phone",
          ],
          'prefix' => [
               'label' => 'Prefixo',
               'placeholder' => 'Prefixo',
          ],
          'logo' => [
               'label' => 'Logo',
               'placeholder' => 'Logo',
          ],
          "domain" => [
               "label" => "Domain",
               "placeholder" => "Domain",
          ],
          'address' => [
               'label' => 'Endereço',
               'placeholder' => 'Endereço',
          ],
          "status" => [
               "label" => "Status",
               "placeholder" => "Status",
               "options" => ["draft" => "Rascunho", "published" => "Publicado"]
          ],
          "description" => [
               "label" => "Descrição",
               "placeholder" => "Descrição",
          ],
     ],
     "columns" => [
          "name" => "Nome",

          "slug" => "Slug",

          "email" => "Email",

          "document" => "Document",

          "phone" => "Phone",

          "domain" => "Domain",

          "status" => "Status",

          "description" => "Descrição",

     ],

];
