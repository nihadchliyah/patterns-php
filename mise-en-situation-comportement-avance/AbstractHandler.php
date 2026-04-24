<?php
require_once 'HandlerInterface.php';

abstract class AbstractHandler implements HandlerInterface {
    private ?HandlerInterface $next = null;
    public function setNext(HandlerInterface $handler): HandlerInterface
    {
        $this->next = $handler;
        return $handler;
    }

    protected function passToNext(Produit $produit): void
    {
        if ($this->next !== null){
            $this->next->handle($produit);
        }
    }
}