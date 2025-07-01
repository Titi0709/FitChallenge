#  Plan de test – Projet FitChallenge

##  Objectif

Ce plan de test a pour objectif de vérifier la conformité, la sécurité et la stabilité de l'application FitChallenge tout au long de son cycle de développement.

---

## Outils utilisés

- Laravel `php artisan test` (utilisation de PHPUnit)
- Tests automatisés via classes `Feature` et `Unit`

---

##  Tests unitaires réalisés

| Fonction | Description | Résultat |
|----------|-------------|----------|
| `calculerPoints()` | Vérifie les points calculés selon le type d'exercice (Cardio, Force, etc.) | ✅ |

---

##  Tests de sécurité

| Fonctionnalité | Scénario testé | Résultat attendu | Statut |
|----------------|----------------|------------------|--------|
| Inscription | Email invalide | Erreur sur `email` | ✅ |
| Inscription | Champs vides | Erreurs sur tous les champs obligatoires | ✅ |
| Route `/admin` | Accès par un non-admin | HTTP 403 Interdit | ✅ |

---

##  Tests fonctionnels

| Fonctionnalité         | Scénario                                 | Résultat attendu                    | Statut |
|------------------------|------------------------------------------|-------------------------------------|--------|
| Création de défi       | Insertion d’un défi via factory Laravel  | Le défi est présent dans la BDD     | ✅     |
| Création de vidéo défi | Insertion d’une vidéo via factory        | La vidéo est liée à un défi existant | ✅    |

---

##  Évolutivité & maintenance

Ce plan est conçu pour être **modulaire et évolutif** :
- Si une nouvelle fonctionnalité est ajoutée, un test peut être ajouté dans un fichier dédié (`NomFeatureTest.php`)
- Chaque test est **isolé**, **reproductible**, et lancé avec `php artisan test`
- La structure permet de détecter les régressions en cas de changement de code

---

##  Exécution

Tous les tests ont été exécutés via :

