<?php

/**
 * Created by Claudio Campos.
 * User: callcocam@gmail.com, contato@sigasmart.com.br
 * https://www.sigasmart.com.br
 */

return [
     "modelLabel" => "Permissõe",
     "pluralModelLabel" => "Permissões",
     "navigationLabel" => "Permissões",
     "navigationGroup" => "Operacional",
     "forms" => [
          "group_id" => [
               "label" => "Group id",
               "placeholder" => "Group id",
          ],
          "name" => [
               "label" => "Nome",
               "placeholder" => "Nome",
          ],
          "slug" => [
               "label" => "Slug",
               "placeholder" => "Slug",
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
          "group_id" => "Group id",

          "name" => "Nome",

          "slug" => "Slug",

          "status" => "Status",

          "description" => "Descrição",

     ],

];
