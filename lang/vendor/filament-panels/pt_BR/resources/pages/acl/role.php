<?php

/**
 * Created by Claudio Campos.
 * User: callcocam@gmail.com, contato@sigasmart.com.br
 * https://www.sigasmart.com.br
 */

return [
     "modelLabel" => "Role",
     "pluralModelLabel" => "Roles",
     "navigationLabel" => "Roles",
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
          "special" => [
               "label" => "Special",
               "placeholder" => "Special",
               "options" => ["all-access" => "Acesso total", "no-access" => "Sem acesso"]
          ],
          "permissions" => [
               "label" => "Permissões",
               "placeholder" => "Permissões",
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

          "special" => "Special",

          "status" => "Status",

          "description" => "Descrição",

     ],

];
