# CTF Web Serveur - injection SQL : Authentification 2

## Présentation du CTF 
**ID** 32 dans **les CTFs de Cyrhades**


# faille SQL, injection SQL Authentification
Dans ce challenge vous devez réussir à vous connecter avec un compte d'un agent immobilier.
Le développeur à fait une modification est récupère le password depuis une requête SQL, puis le compare au SHA1 du mot de passe fourni par l'utilisateur.


-----------

## Installation manuel
Vous n'utilisez pas l'application **les CTFs de Cyrhades** ? C'est dommage !
Mais voici comment installer ce CTF manuellement :

> git clone https://github.com/Hack-Oeil/INJECTION_SQL_AUTHENTIFICATION_2.git

> cd INJECTION_SQL_AUTHENTIFICATION_2 && docker compose up