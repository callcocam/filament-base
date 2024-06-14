<?php

/**
 * Created by Claudio Campos.
 * User: callcocam@gmail.com, contato@sigasmart.com.br
 * https://www.sigasmart.com.br
 */

return [
     "modelLabel" => "Endereço",
     "pluralModelLabel" => "Endereços",
     "navigationLabel" => "Endereços",
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
          "zip" => [
               "label" => "CEP",
               "placeholder" => "CEP",
          ],
          "city" => [
               "label" => "Cidade",
               "placeholder" => "Cidade",
          ],
          "state" => [
               "label" => "Estado/UF",
               "placeholder" => "Estado/UF",
          ],
          "country" => [
               "label" => "País",
               "placeholder" => "País",
          ],
          "street" => [
               "label" => "Rua/Logradouro",
               "placeholder" => "Rua/Logradouro",
          ],
          "district" => [
               "label" => "Bairro/Distrito",
               "placeholder" => "Bairro/Distrito",
          ],
          "number" => [
               "label" => "Número",
               "placeholder" => "Número",
          ],
          "complement" => [
               "label" => "Complemento",
               "placeholder" => "Complemento",
          ],
          "reference" => [
               "label" => "Reference",
               "placeholder" => "Reference",
          ],
          "latitude" => [
               "label" => "Latitude",
               "placeholder" => "Latitude",
          ],
          "longitude" => [
               "label" => "Longitude",
               "placeholder" => "Longitude",
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

          "zip" => "CEP",

          "city" => "Cidade",

          "state" => "Estado/UF",

          "country" => "País",

          "street" => "Rua/Logradouro",

          "district" => "Bairro/Distrito",

          "number" => "Número",

          "complement" => "Complemento",

          "reference" => "Reference",

          "latitude" => "Latitude",

          "longitude" => "Longitude",

          

     ],

];
