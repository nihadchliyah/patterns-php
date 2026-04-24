<?php

class ProductDTO {
    public function __construct(
        public readonly ?int   $id,
        public readonly string $nom,
        public readonly float  $prix,
        public readonly int    $stock
    ) {}
}
