# 3bci-Exam

Pour traviller sur le projet, veuillez le cloner.

Une fois cloner il faut modifier le .env afin de connecter la base de donnée de vottre choix. 

Une fois le .env modifier on ouvre un terminal et on lance la commande : 
symfony console doctrine:database:create

puis 

symfony console make:migrations

puis 

symfony console doctrine:migrations:migrate

puis

symfony console doctrine:fixture:load

et enfin symfony server:start
