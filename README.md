# PHP Design Patterns — Mises en situation

Ce repo regroupe **4 mises en situation PHP** couvrant les grandes familles de design patterns : création, structure, comportement et architecture. Chaque exercice est autonome dans son dossier et tourne sur la même base de données `boutique` (MariaDB).

---

## Prérequis

- PHP 8.1+
- MariaDB / MySQL avec une base `boutique` existante
- Serveur local type XAMPP, WAMP ou Laragon

---

## Installation

```bash
git clone https://github.com/<ton-pseudo>/patterns-php.git
cd patterns-php
```

Créer la base de données une seule fois :

```sql
CREATE DATABASE IF NOT EXISTS boutique;
```

Chaque exercice crée ses propres tables automatiquement au premier lancement (via `CREATE TABLE IF NOT EXISTS`).

---

## Structure du repo

```
patterns-php/
├── Database.php                              ← Connexion PDO partagée (Singleton)
├── mise-en-situation-creation/               ← Patterns de création
├── mise-en-situation-structure-avance/       ← Patterns structuraux
├── mise-en-situation-comportement-avance/    ← Patterns comportementaux
└── mise-en-situation-patterns-architecturaux/← Patterns architecturaux
```

---

## Les 4 exercices

---

### 1. Patterns de création — Factory Method

**Dossier :** `mise-en-situation-creation/`

**Sujet :** Créer différents types de produits (Simple, Digital, Service) sans exposer la logique d'instanciation.

**Patterns utilisés :**
| Pattern | Rôle |
|---|---|
| **Factory Method** | `ProductFactory::create()` instancie le bon type de produit selon un paramètre string |
| **Singleton** | `Database` — une seule connexion PDO partagée |

**Fichiers clés :**
- `ProductFactory.php` — fabrique les produits
- `SimpleProduct.php`, `DigitalProduct.php`, `ServiceProduct.php` — les types concrets
- `Product.php` — classe de base abstraite

**Lancer :**
```bash
php mise-en-situation-creation/index.php
```

---

### 2. Patterns structuraux — Proxy & Facade

**Dossier :** `mise-en-situation-structure-avance/`

**Sujet :** Gérer une boutique avec validation des produits avant ajout, en simplifiant l'interface d'accès.

**Patterns utilisés :**
| Pattern | Rôle |
|---|---|
| **Proxy** | `ProduitManagerProxy` intercepte les appels à `ProduitManager` et refuse les prix négatifs |
| **Facade** | `BoutiqueFacade` expose une interface simple (`ajouterProduit`, `afficherProduit`) qui cache la complexité interne |

**Flux :**
```
index.php
  └── BoutiqueFacade
        └── ProduitManagerProxy   ← validation (prix >= 0)
              └── ProduitManager  ← stockage en mémoire
```

**Lancer :**
```bash
php mise-en-situation-structure-avance/index.php
```

---

### 3. Patterns comportementaux — Chain of Responsibility & Command

**Dossier :** `mise-en-situation-comportement-avance/`

**Sujet :** Valider et exécuter des opérations sur des produits (ajout, modification, suppression) via une chaîne de validation et un système de commandes.

**Patterns utilisés :**
| Pattern | Rôle |
|---|---|
| **Chain of Responsibility** | `PrixHandler → StockHandler → NomHandler` — chaque handler valide un champ et passe au suivant |
| **Command** | `AjouterProduitCommand`, `ModifierProduitCommand`, `SupprimerProduitCommand` — encapsule chaque action |
| **Singleton** | `Database` — connexion PDO unique |

**Flux :**
```
index.php
  └── CommandInvoker::run(Command)
        └── Command::execute()
              └── Chaîne de validation (Prix → Stock → Nom)
                    └── ProduitRepository (SQL)
```

**Lancer :**
```bash
php mise-en-situation-comportement-avance/index.php
```

---

### 4. Patterns architecturaux — Service, Repository & DTO

**Dossier :** `mise-en-situation-patterns-architecturaux/`

**Sujet :** Module de gestion de produits avec une séparation stricte des responsabilités entre couches.

**Patterns utilisés :**
| Pattern | Rôle |
|---|---|
| **Repository** | `ProductRepository` — isole tout le SQL, le reste du code ne touche jamais PDO |
| **Service** | `ProductService` — logique métier (vérification existence avant update/delete) |
| **DTO** | `ProductDTO` — objet immutable qui circule entre couches, l'entité ne sort jamais du Service |
| **Singleton** | `Database` — connexion PDO unique |

**Flux :**
```
index.php
  └── ProductService        ← reçoit et renvoie des DTO
        └── ProductRepository    ← travaille avec des Entity
              └── PDO / boutique (table : produits)
```

**Lancer :**
```bash
php mise-en-situation-patterns-architecturaux/public/index.php
```

---

## Base de données

Toutes les mises en situation utilisent la base `boutique`.  
Les tables sont créées automatiquement au premier lancement de chaque exercice.

| Exercice | Table |
|---|---|
| création | `products` |
| structure avancée | *(stockage mémoire, pas de table)* |
| comportement avancé | `produits` |
| patterns architecturaux | `produits` |

---

## Vue d'ensemble des patterns

| Famille | Patterns | Exercice |
|---|---|---|
| Création | Factory Method, Singleton | mise-en-situation-creation |
| Structure | Proxy, Facade | mise-en-situation-structure-avance |
| Comportement | Chain of Responsibility, Command | mise-en-situation-comportement-avance |
| Architecture | Repository, Service, DTO, Singleton | mise-en-situation-patterns-architecturaux |
