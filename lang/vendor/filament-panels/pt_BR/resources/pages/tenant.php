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
               "label" => "Documento",
               "placeholder" => "CPF/CNPJ",
          ],
          "phone" => [
               "label" => "Número de telefone",
               "placeholder" => "Número de telefone",
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
               "label" => "Dominio",
               "placeholder" => "Dominio",
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
          'roles' => [
               'label' => 'Funções',
          ]
     ],
     "columns" => [
          "name" => "Nome",

          "slug" => "Slug",

          "email" => "Email",

          "document" => "CPF/CNPJ",

          "phone" => "Telefone",

          "domain" => "Dominio",

          "status" => "Status",

          "description" => "Descrição",

          'roles' => 'Funções',

          'avatar_url' => 'Avatar url',

     ],

];
