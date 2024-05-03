## Instrukcja instalacji

### Wymagane kroki - docker
1. Wykonaj polecenie `docker-compose up -d` w głównym katalogu powyższego repozytorium w celu postawienia kontenerów.

### Wymagane kroki - backend
1. Wykonaj polecenie `docker exec stockpress-backend-1 composer install` w celu zainstalowania zależności.
2. Wykonaj migracje bazy danych za pomocą polecenia `docker exec stockpress-backend-1 php artisan migrate`.
3. Ustaw odpowiednie uprawnienia wykonując polecenie `docker exec stockpress-backend-1 chown www-data:www-data storage -R`.

### Wymagane kroki - frontend
1. Aby zainstalować zależności frontendowe, wykonaj polecenie `docker exec -it stockpress-frontend-1 npm install`.
2. Zbuduj projekt, korzystając z polecenia `docker exec -it stockpress-frontend-1 npm run build`.
3. W celu uruchomienia projektu wykonaj polecenie `docker exec -it stockpress-frontend-1 npm run start &`.

### Aplikacja powinna być od teraz dostępna lokalnie pod adresem: [http://172.45.101.11](http://172.45.101.11)
