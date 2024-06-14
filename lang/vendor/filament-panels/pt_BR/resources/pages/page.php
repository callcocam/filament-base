<?php

/**
 * Created by Claudio Campos.
 * User: callcocam@gmail.com, contato@sigasmart.com.br
 * https://www.sigasmart.com.br
 */

return [
     "modelLabel" => "Page",
     "pluralModelLabel" => "Pages",
     "navigationLabel" => "Pages",
     "navigationGroup" => "Models",
     "sections" => [
          "content" => "Content",
          "information" => "Information",
     ],
     "forms" => [
          "name" => [
               "label" => "Nome",
               "placeholder" => "Nome",
          ],
          "slug" => [
               "label" => "Slug",
               "placeholder" => "Slug",
          ],
          "route" => [
               "label" => "Route",
               "placeholder" => "Route",
          ],
          "icon" => [
               "label" => "Icon",
               "placeholder" => "Icon",
          ],
          "layout" => [
               "label" => "Layout",
               "placeholder" => "Layout",
          ],
          "template" => [
               "label" => "Template",
               "placeholder" => "Template",
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

          "route" => "Route",

          "icon" => "Icon",

          "layout" => "Layout",

          "template" => "Template",

          "status" => "Status",

          "description" => "Descrição",

     ],

];
