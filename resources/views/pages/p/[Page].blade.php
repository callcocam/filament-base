<?php
 
use function Laravel\Folio\name;
 
name('pages.index');
?>
<x-app-layout>
    <livewire:posts :page="$page" />
</x-app-layout>
