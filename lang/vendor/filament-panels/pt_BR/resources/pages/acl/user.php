<?php

/**
 * Created by Claudio Campos.
 * User: callcocam@gmail.com, contato@sigasmart.com.br
 * https://www.sigasmart.com.br
 */

return [
     "modelLabel" => "User",
     "pluralModelLabel" => "Users",
     "navigationLabel" => "Users",
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
          "phone" => [
               "label" => "Phone",
               "placeholder" => "Phone",
          ],
          "document" => [
               "label" => "Document",
               "placeholder" => "Document",
          ],
          "avatar_url" => [
               "label" => "Avatar url",
               "placeholder" => "Avatar url",
          ],
          "password" => [
               "label" => "Password",
               "placeholder" => "Password",
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
          "email_verified_at" => [
               "label" => "Email verified at",
               "placeholder" => "Email verified at",
          ],
          "remember_token" => [
               "label" => "Remember token",
               "placeholder" => "Remember token",
          ],
     ],
     "columns" => [
          "name" => "Nome",

          "slug" => "Slug",

          "email" => "Email",

          "phone" => "Phone",

          "document" => "Document",

          "avatar_url" => "Avatar url",

          "password" => "Password",

          "status" => "Status",

          "description" => "Descrição",

          "email_verified_at" => "Email verified at",

          "remember_token" => "Remember token",

     ],

];
