<?php
 interface HandlerInterface {
    public function setNext(HandlerInterface $handler): HandlerInterface;
    public function handle(Produit $produit): void;
 }